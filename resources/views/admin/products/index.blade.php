@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Products</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        + Add New Product
    </a>
</div>

<div class="bg-white shadow-md rounded my-6 overflow-hidden">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Name</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Price</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Stock</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($products as $product)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">{{ $product->name }}</td>
                <td class="py-3 px-4">₱{{ $product->price }}</td>
                <td class="py-3 px-4">{{ $product->stock }}</td>
                <td class="py-3 px-4">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">
            Edit
        </a>

        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" 
              onsubmit="return confirm('Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            
            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                Delete
            </button>
        </form>
    </div>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="p-4">
        {{ $products->links() }}
    </div>
</div>
@endsection