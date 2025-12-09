<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }
    /**
     * Show the form for creating a new resource.
     */
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. UPDATED VALIDATION (Added category_id)
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id', // <--- THIS WAS MISSING
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer', // Also added stock to be safe
            'description' => 'required|string', // And description
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Handle Image Upload
        if ($request->hasFile('image')) {
            // Save into storage/app/public/products
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        // 3. Create Slug
        $validated['slug'] = \Illuminate\Support\Str::slug($request->name);

        // 4. Save to Database
        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // 1. Show the Edit Form
    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // 2. Update the Product in Database
    public function update(Request $request, $id)
    {
        $product = \App\Models\Product::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle Image Upload (Only if they uploaded a new one)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($request->name);

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product Updated Successfully');
    }
    /**
     * Update the specified resource in storage.
     */
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
    /**
     * Remove the specified resource from storage.
     */
    // Delete a product
    public function destroy($id)
    {
        // 1. Find the product
        $product = \App\Models\Product::findOrFail($id);

        // 2. Delete the image file if it exists (cleanup)
        if ($product->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }

        // 3. Delete the record from the database
        $product->delete();

        // 4. Redirect back to the list
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }
}
