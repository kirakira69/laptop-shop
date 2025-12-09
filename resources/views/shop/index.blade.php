@extends('layouts.shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Latest Laptops</h1>
        
        @if(request('search'))
            <p class="text-gray-500 mt-2 md:mt-0">
                Results for: <span class="font-bold text-indigo-600">"{{ request('search') }}"</span>
            </p>
        @endif
    </div>
    
    <div class="flex gap-4 mb-8 overflow-x-auto pb-2">
        <a href="{{ route('shop.index') }}" 
           class="px-4 py-2 bg-white border {{ !request('category') ? 'border-indigo-500 text-indigo-600 ring-1 ring-indigo-500' : 'border-gray-300 text-gray-700' }} rounded-full hover:bg-gray-50 text-sm font-medium transition">
           All
        </a>
        <a href="?category=gaming" 
           class="px-4 py-2 bg-white border {{ request('category') == 'gaming' ? 'border-indigo-500 text-indigo-600 ring-1 ring-indigo-500' : 'border-gray-300 text-gray-700' }} rounded-full hover:bg-gray-50 text-sm font-medium transition">
           Gaming
        </a>
        <a href="?category=ultrabook" 
           class="px-4 py-2 bg-white border {{ request('category') == 'ultrabook' ? 'border-indigo-500 text-indigo-600 ring-1 ring-indigo-500' : 'border-gray-300 text-gray-700' }} rounded-full hover:bg-gray-50 text-sm font-medium transition">
           Ultrabooks
        </a>
    </div>

    @if($products->count() > 0)
        
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition duration-300 group">
                <div class="relative h-48 bg-gray-100">
                    <img src="{{ $product->image ? Storage::url($product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                <div class="p-5">
                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-wide">{{ $product->category->name ?? 'Laptop' }}</span>
                    <h2 class="text-lg font-bold mt-1 text-gray-900 leading-tight">{{ $product->name }}</h2>
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $product->description }}</p>
                    
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xl font-bold text-gray-900">₱{{ number_format($product->price, 2) }}</span>
                        
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-indigo-600 text-white p-2 rounded-lg hover:bg-indigo-700 transition shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    @else

        <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-dashed border-gray-300">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">No products found</h2>
            <p class="text-gray-500 mt-2 max-w-sm mx-auto">
                We couldn't find any laptops matching <span class="font-semibold text-gray-700">"{{ request('search') }}"</span>. 
                Try checking for typos or use a different keyword.
            </p>
            
            <a href="{{ route('shop.index') }}" class="mt-6 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                Clear Search & View All
            </a>
        </div>

    @endif

</div>
@endsection