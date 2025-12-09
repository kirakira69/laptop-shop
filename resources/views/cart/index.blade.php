@extends('layouts.shop')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-8">Shopping Cart</h1>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif


    @if(empty($cart) || count($cart) == 0)
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Your cart is empty.</p>
            <a href="{{ route('shop.index') }}" class="text-indigo-600 hover:underline mt-4 inline-block">Continue Shopping</a>
        </div>
    @else
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Select
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($cart as $id => $details)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" 
                                   name="selected_products[]" 
                                   value="{{ $id }}" 
                                   form="checkout-form" 
                                   data-subtotal="{{ $details['price'] * $details['quantity'] }}"
                                   checked
                                   class="h-5 w-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $details['name'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">₱{{ number_format($details['price'], 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center space-x-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" 
                                       class="w-16 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-center">
                                <button type="submit" class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-700 px-2 py-1 rounded">Update</button>
                            </form>
                            
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="mt-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-600 hover:text-red-900 underline">Remove</button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">₱{{ number_format($details['price'] * $details['quantity'], 2) }}</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                
                <a href="{{ route('shop.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                    &larr; Continue Shopping
                </a>

                <div class="flex items-center gap-6">
                    <span id="cart-total" class="text-xl font-bold">Total: ₱{{ number_format($total, 2) }}</span>
                    
                    <form id="checkout-form" action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 font-bold shadow-lg transition transform hover:-translate-y-0.5">
                            Proceed to Checkout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    @endif
</div>
<script>
    // 1. Select all checkboxes and the total display element
    const checkboxes = document.querySelectorAll('input[name="selected_products[]"]');
    const totalDisplay = document.getElementById('cart-total');

    // 2. Function to calculate the sum
    function recalculateTotal() {
        let total = 0;

        checkboxes.forEach(box => {
            // Only add the price if the box is CHECKED
            if (box.checked) {
                total += parseFloat(box.getAttribute('data-subtotal'));
            }
        });

        // 3. Update the text on the screen (formatting it as currency)
        totalDisplay.innerText = 'Total: $' + total.toLocaleString('en-US', {
            minimumFractionDigits: 2, 
            maximumFractionDigits: 2
        });
    }

    // 4. Attach the event listener to every checkbox
    checkboxes.forEach(box => {
        box.addEventListener('change', recalculateTotal);
    });
</script>
@endsection