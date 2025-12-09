<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService; // Import the service

class CartController extends Controller
{
    protected $cartService;

    // 1. Dependency Injection (Requirement 2D)
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    // 2. Display the Cart Page
    public function index()
    {
        // Get cart from session, default to empty array if null
        $cart = session()->get('cart', []);
        
        // Calculate total using the service
        $total = $this->cartService->getTotal();

        return view('cart.index', compact('cart', 'total'));
    }

    // 3. Add Item to Cart
    public function addToCart(Request $request, $id)
    {
        // 1. Block Admins from adding items
        if(auth()->check() && auth()->user()->is_admin) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'Admins cannot shop. Please log in as a customer.');
        }

        // ... Keep the rest of your existing logic below ...
        $quantity = $request->input('quantity', 1);
        $this->cartService->addToCart($id, $quantity);
        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }
    // ... keep your existing index and addToCart functions ...

    // ADD THESE NEW FUNCTIONS
    public function update(Request $request, $id)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        
        $this->cartService->updateQuantity($id, $request->quantity);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        $this->cartService->removeItem($id);

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }

    
}
