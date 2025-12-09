<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function addToCart($id, $quantity)
    {
        $cart = Session::get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $product = Product::findOrFail($id);
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        Session::put('cart', $cart);
    }
    // ... keep your existing addToCart and getTotal functions ...

    // ADD THESE NEW FUNCTIONS
    public function updateQuantity($id, $quantity)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            $cart[$id]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }
    }

    public function removeItem($id)
    {
        $cart = session()->get('cart', []);
        
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
    }

    public function getTotal()
    {
        return collect(Session::get('cart'))->sum(function($details) {
            return $details['price'] * $details['quantity'];
        });
    }
}