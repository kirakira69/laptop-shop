<?php

namespace App\Http\Controllers;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Models\Product; // Import the Product model
use App\Models\Category; // Import the Category model

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Start the query
        $query = Product::query();

        // 1. Search Logic
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // 2. Category Filter Logic
        if ($request->filled('category')) {
            $slug = $request->category;
            $query->whereHas('category', function($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }
        
        // 3. Get products (active only)
        $products = $query->where('is_active', true)->get();

        // 4. Return the view with the products
        return view('shop.index', compact('products'));
    }

    public function about()
    {
        return view('shop.about');
    }

    public function contact()
    {
        return view('shop.contact');
    }

    public function system()
    {
        return view('shop.system');
    }

    // --- NEW FUNCTION ADDED HERE ---
    public function sendMessage(Request $request)
    {
        // 1. Validate inputs
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:10'
        ]);

        // 2. Save to Database
        ContactMessage::create($validated);

        // 3. Redirect back with success message
        return redirect()->back()->with('success', 'Thank you! Your message has been sent to our team.');
    }

} // <--- End of Class