<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // 1. List all orders (Newest first)
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // 2. View a specific order's items
    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // 3. Update Status (Accept or Cancel)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated to ' . ucfirst($request->status));
    }
    // Delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // This will automatically delete related OrderItems 
        // because we set onDelete('cascade') in the migration earlier.
        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully!');
    }
}
