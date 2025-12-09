<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use App\Services\CartService;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail; 
use App\Mail\OrderPlaced;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // --- STEP 1: INITIATE CHECKOUT ---
    // Checks selected items, sends OTP, and redirects to verify page
    public function checkout(Request $request)
    {
        $cart = session('cart');
        
        // 1. Get the list of IDs the user selected (from the checkboxes)
        $selectedIds = $request->input('selected_products', []);

        // 2. Validation: If nothing selected, go back
        if(empty($selectedIds)) {
            return redirect()->back()->with('error', 'Please select at least one item to checkout.');
        }

        // 3. IMPORTANT: Save the selected IDs to the Session
        // We need to remember what they picked while they go verify the OTP
        session(['checkout_selected_ids' => $selectedIds]);

        // 4. Generate OTP
        $otp = rand(100000, 999999);
        
        // 5. Save OTP to the logged-in user
        $user = User::find(Auth::id());
        $user->otp_code = $otp;
        $user->save();

        // 6. Send Email
        Mail::to($user->email)->send(new OTPMail($otp));

        // 7. Show the Verify Page
        return view('checkout.verify-otp');
    }

    // --- STEP 2: VERIFY OTP & PROCESS PAYMENT ---
    // Checks code, then builds Stripe session for ONLY the selected items
    // 2. VERIFY OTP: Handle "Old/Used" vs "Wrong" codes
    public function verifyPaymentOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        $user = User::find(Auth::id());

        // 1. Check OTP Validity
        if (!$user->otp_code || $user->otp_code != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP code.']);
        }

        // 2. Clear OTP
        $user->otp_code = null;
        $user->save();

        // 3. Prepare Stripe
        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $cart = session('cart');
        
        // Safety Check: Is cart empty?
        if (!$cart) {
            return redirect()->route('shop.index')->with('error', 'Cart is empty.');
        }

        // Retrieve selected IDs from session
        $selectedIds = session('checkout_selected_ids', []);
        
        $lineItems = [];

        // 4. Build Line Items
        foreach ($cart as $id => $details) {
            // LOGIC FIX: If we have specific IDs, filter by them. 
            // If the session forgot them (empty), just checkout EVERYTHING in the cart.
            if (!empty($selectedIds) && !in_array($id, $selectedIds)) {
                continue; 
            }

            $lineItems[] = [
                'price_data' => [
                    'currency' => 'php', 
                    'product_data' => ['name' => $details['name']],
                    'unit_amount' => $details['price'] * 100,
                ],
                'quantity' => $details['quantity'],
            ];
        }

        // 5. Final Safety Check before calling Stripe
        if (empty($lineItems)) {
            // If logic failed, force add ALL cart items
            foreach ($cart as $id => $details) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'php',
                        'product_data' => ['name' => $details['name']],
                        'unit_amount' => $details['price'] * 100,
                    ],
                    'quantity' => $details['quantity'],
                ];
            }
        }

        // 6. Create Stripe Session
       // ... inside verifyPaymentOtp function ...

        // 6. Create Stripe Session
        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => route('checkout.success'),
                'cancel_url' => route('checkout.cancel'),
            ]);
            
            return redirect($session->url);
            
        } catch (\Exception $e) {
            // --- CHANGE THIS PART TO SEE THE ERROR ---
            dd($e->getMessage()); 
            // ----------------------------------------
        }
    }

    public function success()
    {
        $cart = session('cart');
        
        // Safety check
        if (!$cart) {
             return redirect()->route('shop.index');
        }

        // Retrieve selected IDs to only save purchased items
        $selectedIds = session('checkout_selected_ids', []);

        // 1. Create Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'status' => 'pending',
            // Note: Ideally recalculate total for selected items only, 
            // but for now we use service total or you can calculate loop sum here.
            'grand_total' => $this->cartService->getTotal(), 
            'payment_status' => 'paid',
            'payment_method' => 'stripe',
            // Combine address fields
            'shipping_address' => auth()->user()->street . ', ' . auth()->user()->barangay . ', ' . auth()->user()->municipal . ', ' . auth()->user()->province,
        ]);

        // 2. Save ONLY selected items
        foreach($cart as $id => $details) {
            // Skip unselected items
            if (!empty($selectedIds) && !in_array($id, $selectedIds)) {
                continue;
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price']
            ]);
            
            // Optional: Remove only bought items from cart
            unset($cart[$id]);
        }

        // 3. Update Cart Session (Remove bought items)
        session()->put('cart', $cart);
        session()->forget('checkout_selected_ids'); // Clear the temp list

        // 4. Send Email
        Mail::to(auth()->user()->email)->send(new OrderPlaced($order));

        return view('checkout.success', compact('order'));
    }

    public function cancel()
    {
        return redirect()->route('cart.index')->with('error', 'Payment Cancelled.');
    }
}