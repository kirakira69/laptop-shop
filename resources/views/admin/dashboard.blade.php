@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-8">Admin Overview</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-indigo-500">
        <h3 class="text-gray-500 text-sm font-bold uppercase">Total Revenue</h3>
        <p class="text-2xl font-bold text-gray-800">₱{{ number_format($totalRevenue, 2) }}</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
        <h3 class="text-gray-500 text-sm font-bold uppercase">Total Orders</h3>
        <p class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
        <h3 class="text-gray-500 text-sm font-bold uppercase">Products</h3>
        <p class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
        <h3 class="text-gray-500 text-sm font-bold uppercase">Pending Orders</h3>
        <p class="text-2xl font-bold text-gray-800">{{ $pendingOrders }}</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-orange-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase">Total Users</h3>
            <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
    </div>
    
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-red-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase">Total Messages</h3>
            <p class="text-2xl font-bold text-gray-800">{{ $totalMessages }}</p>
        </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
    <div class="flex gap-4">
        <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            + Add New Product
        </a>
        <a href="{{ route('admin.products.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
            View All Products
        </a>
    </div>
</div>
@endsection