<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Driver;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalDrivers = Driver::count();
        $ordersToday = Pesanan::whereDate('created_at', now())->count();
        $revenueToday = Pesanan::whereDate('created_at', now())
            ->where('status', 'completed')
            ->sum('price');

        $recentOrders = Pesanan::with('user','driver')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalDrivers' => $totalDrivers,
            'ordersToday' => $ordersToday,
            'revenueToday' => $revenueToday,
            'recentOrders' => $recentOrders,
        ]);
    }
}
