<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Driver;
use App\Models\Pesanan;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        /**
         * ======================
         * KPI DASAR
         * ======================
         */
        $totalUsers   = User::count();
        $activeUsers  = User::where('status', 'aktif')->count();

        $totalDrivers  = Driver::count();
        $onlineDrivers = Driver::where('online', 1)->count();
        $offlineDrivers = Driver::where('online', 0)->count();

        $totalOrders      = Pesanan::count();
        $completedOrders  = Pesanan::where('status', 'completed')->count();

        /**
         * ======================
         * RECENT ACTIVITY
         * ======================
         */
        $recentOrders  = Pesanan::latest()->limit(5)->get();
        $recentUsers   = User::latest()->limit(5)->get();
        $recentDrivers = Driver::latest()->limit(5)->get();

        /**
         * ======================
         * CHART DATA
         * ======================
         */
        $orderPending   = Pesanan::where('status', 'pending')->count();
        $orderAccepted  = Pesanan::where('status', 'accepted')->count();
        $orderCompleted = Pesanan::where('status', 'completed')->count();

        /**
         * ======================
         * TOP STATISTIK (INSIGHTS)
         * ======================
         */

        // 🔝 TOP RATING DRIVER
        $topRatedRaw = Rating::select(
                'driver_id',
                DB::raw('AVG(rating) as avg_rating')
            )
            ->whereNotNull('driver_id')
            ->groupBy('driver_id')
            ->orderByDesc('avg_rating')
            ->first();

        $topRatedDriver = null;

        if ($topRatedRaw) {
            $driver = Driver::find($topRatedRaw->driver_id);

            if ($driver) {
                $topRatedDriver = (object) [
                    'name' => $driver->name,
                    'avg_rating' => round($topRatedRaw->avg_rating, 1),
                ];
            }
        }

        // 🔝 DRIVER DENGAN ORDER TERBANYAK
        $mostActiveRaw = Driver::withCount('pesanans')
            ->orderByDesc('pesanans_count')
            ->first();

        $mostActiveDriver = null;

        if ($mostActiveRaw) {
            $mostActiveDriver = (object) [
                'name' => $mostActiveRaw->name,
                'total_orders' => $mostActiveRaw->pesanans_count,
            ];
        }
        

        /**
         * ======================
         * RETURN KE VIEW
         * ======================
         */
        return view('admin.dashboard', compact(
            'totalUsers',
            'activeUsers',
            'totalDrivers',
            'onlineDrivers',
            'offlineDrivers',
            'totalOrders',
            'completedOrders',
            'recentOrders',
            'recentUsers',
            'recentDrivers',
            'orderPending',
            'orderAccepted',
            'orderCompleted',
            'topRatedDriver',
            'mostActiveDriver'
        ));
    }
}