<?php

use App\Models\Order;
use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\Auth\OTPController; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController; 

// --- 1. Public Routes (Accessible by Guests) ---
Route::get('/', [ShopController::class, 'index'])->name('shop.index');

// --- OTP ROUTES (Must be public) ---
Route::get('/verify-otp', [OTPController::class, 'show'])->name('otp.verify');
Route::post('/verify-otp', [OTPController::class, 'verify'])->name('otp.check');

// Cart Routes
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Static Pages
Route::get('/about-us', [ShopController::class, 'about'])->name('shop.about');
Route::get('/about-system', [ShopController::class, 'system'])->name('shop.system');

// Contact Us Routes
Route::get('/contact-us', [ShopController::class, 'contact'])->name('shop.contact');
Route::post('/contact-us', [ShopController::class, 'sendMessage'])->name('shop.contact.store');


// --- 2. User Dashboard ---
Route::get('/dashboard', function () {
    $orders = Order::where('user_id', auth()->id())->latest()->get();
    return view('dashboard', compact('orders'));
})->middleware(['auth', 'verified'])->name('dashboard');


// --- 3. Authenticated Routes (Must be Logged In) ---
Route::middleware('auth')->group(function () {
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // --- CHECKOUT ROUTES (UPDATED) ---
    
    // 1. SAFETY NET: Redirects GET requests back to cart (Prevents the error)
    // *** ADD THIS SECTION HERE ***
    Route::get('/checkout', function() {
        return redirect()->route('cart.index');
    });
    // *****************************

    // 2. Initiate Checkout (Sends Email OTP)
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    
    // 3. Verify OTP (If correct -> Redirect to Stripe)
    Route::post('/checkout/verify', [CheckoutController::class, 'verifyPaymentOtp'])->name('checkout.verify');
    
    // 4. Success/Cancel from Stripe
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
});


// --- 4. Admin Routes ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Product Management
    Route::resource('products', ProductController::class);

    // Order Management
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{id}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');
    //message
    Route::get('/messages', [App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
    Route::delete('/messages/{id}', [App\Http\Controllers\Admin\MessageController::class, 'destroy'])->name('messages.destroy');
    //acount disable
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{id}/toggle', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggle');

    Route::get('/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
});

require __DIR__.'/auth.php';