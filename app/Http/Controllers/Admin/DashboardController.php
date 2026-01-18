<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'total_revenue' => Order::whereIn('status', ['delivered', 'shipped', 'processing'])->sum('total'),
            'total_products' => Product::count(),
            'total_users' => User::where('is_admin', false)->count(),
        ];

        $recentOrders = Order::with('user')
            ->latest()
            ->take(10)
            ->get();

        $lowStockProducts = Product::where('quantity', '<', 10)
            ->where('quantity', '>', 0)
            ->orderBy('quantity', 'asc')
            ->take(10)
            ->get();

        $outOfStockCount = Product::where('quantity', 0)->count();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStockProducts', 'outOfStockCount'));
    }
}
