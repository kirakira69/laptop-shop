@extends('layouts.admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">Order Details: #{{ $order->order_number }}</h1>
    <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:underline">&larr; Back to List</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    
    <div class="md:col-span-2 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold mb-4">Items Ordered</h2>
        <table class="w-full">
            <thead>
                <tr class="border-b text-left text-gray-500 text-sm">
                    <th class="pb-2">Product</th>
                    <th class="pb-2">Quantity</th>
                    <th class="pb-2">Price</th>
                    <th class="pb-2">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr class="border-b">
                    <td class="py-4">
                        <p class="font-bold text-gray-800">{{ $item->product->name }}</p>
                    </td>
                    <td class="py-4">{{ $item->quantity }}</td>
                    <td class="py-4">${{ number_format($item->price, 2) }}</td>
                    <td class="py-4 font-bold text-gray-800">${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 text-right">
            <p class="text-2xl font-bold text-gray-900">Grand Total: ${{ number_format($order->grand_total, 2) }}</p>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 h-fit">
        <h2 class="text-xl font-bold mb-4">Order Status</h2>
        
        <div class="mb-6">
            <p class="text-gray-600 text-sm uppercase">Current Status</p>
            <span class="px-3 py-1 rounded-full text-sm font-bold block w-fit mt-1
                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <h2 class="text-xl font-bold mb-4">Actions</h2>

        @if($order->status == 'pending')
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mb-2">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="processing">
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-bold">
                Accept & Process Order
            </button>
        </form>
        @endif

        @if($order->status == 'processing')
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mb-2">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="completed">
            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 font-bold">
                Mark as Completed
            </button>
        </form>
        @endif

        @if($order->status != 'cancelled' && $order->status != 'completed')
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <input type="hidden" name="status" value="cancelled">
            <button type="submit" class="w-full bg-red-100 text-red-700 py-2 rounded hover:bg-red-200 font-bold border border-red-200">
                Cancel Order
            </button>
        </form>
        @endif

        <div class="mt-8 border-t pt-4">
            <h3 class="font-bold text-gray-800">Customer Info</h3>
            <p class="text-gray-600">{{ $order->user->name }}</p>
            <p class="text-gray-600">{{ $order->user->email }}</p>
        </div>
    </div>
</div>
@endsection