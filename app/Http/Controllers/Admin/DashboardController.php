<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\ContactMessage; // <--- 1. ADD THIS IMPORT

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalRevenue = Order::sum('grand_total');
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalUsers = User::count();
        
        // 2. ADD THIS LINE: Count total messages
        $totalMessages = ContactMessage::count();

        // 3. ADD 'totalMessages' TO THE COMPACT LIST
        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalRevenue', 'pendingOrders', 'totalUsers', 'totalMessages'));
    }
}