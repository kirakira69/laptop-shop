@extends('layouts.shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16 text-center">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto">
        <div class="mb-6">
            <svg class="w-16 h-16 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Payment Successful!</h1>
        <p class="text-gray-600 mb-8">Thank you for your purchase. Your order number is <span class="font-bold text-indigo-600">{{ $order->order_number }}</span>.</p>
        
        <p class="text-gray-500 mb-8">We have sent a confirmation email to your inbox.</p>

        <a href="{{ route('shop.index') }}" class="inline-block bg-indigo-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-indigo-700 transition duration-300">
            Continue Shopping
        </a>
    </div>
</div>
@endsection