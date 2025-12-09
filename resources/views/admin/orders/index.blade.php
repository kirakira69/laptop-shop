@extends('layouts.admin')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Manage Orders</h1>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 text-left">Order ID</th>
                <th class="py-3 px-4 text-left">Customer</th>
                <th class="py-3 px-4 text-left">Date</th>
                <th class="py-3 px-4 text-left">Status</th>
                <th class="py-3 px-4 text-left">Total</th>
                <th class="py-3 px-4 text-left">Action</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @foreach($orders as $order)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4 font-bold">#{{ $order->order_number }}</td>
                <td class="py-3 px-4">{{ $order->user->name }}</td>
                <td class="py-3 px-4">{{ $order->created_at->format('M d, Y') }}</td>
                <td class="py-3 px-4">
                    <span class="px-2 py-1 rounded text-xs font-bold 
                        {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $order->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="py-3 px-4">₱{{ number_format($order->grand_total, 2) }}</td>
                <td class="py-3 px-4 flex items-center gap-2">
    <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700">
        View
    </a>

    <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" 
          onsubmit="return confirm('Are you sure you want to delete Order #{{ $order->order_number }}?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
            Delete
        </button>
    </form>
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection