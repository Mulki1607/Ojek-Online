<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class AdminDriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::with('kendaraan')
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('admin.drivers.index', compact('drivers'));
    }

    public function toggle($id)
    {
        $driver = Driver::findOrFail($id);

        $driver->update([
            'online' => $driver->online ? 0 : 1
        ]);

        return back()->with('success', 'Status driver diperbarui.');
    }
            public function orders(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $query = Pesanan::where('driver_id', $driver->id);

        // 🔹 FILTER STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 🔹 FILTER PERIODE
        if ($request->period === 'today') {
            $query->whereDate('created_at', today());
        }

        if ($request->period === 'week') {
            $query->where('created_at', '>=', now()->subDays(7));
        }

        if ($request->period === 'month') {
            $query->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        }

        $orders = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.drivers.orders', compact('driver', 'orders'));
    }
}