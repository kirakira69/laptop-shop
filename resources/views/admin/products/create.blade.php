@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Add New Product</h1>

<div class="bg-white p-6 rounded shadow-md max-w-2xl">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
            <input type="text" name="name" required class="w-full border rounded px-3 py-2 text-gray-700 focus:outline-none focus:border-indigo-500">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
            <select name="category_id" class="w-full border rounded px-3 py-2 text-gray-700">
                @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea name="description" rows="4" required class="w-full border rounded px-3 py-2 text-gray-700"></textarea>
        </div>

        <div class="flex gap-4 mb-4">
            <div class="w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Price (₱)</label>
                <input type="number" step="0.01" name="price" required class="w-full border rounded px-3 py-2 text-gray-700">
            </div>
            
            <div class="w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2">Stock Quantity</label>
                <input type="number" name="stock" required class="w-full border rounded px-3 py-2 text-gray-700">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Product Image</label>
            <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"/>
        </div>

        <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-6 rounded hover:bg-indigo-700 transition">
            Save Product
        </button>
    </form>
</div>
@endsection