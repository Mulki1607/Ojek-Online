<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\Wallet;

class DriverOrderController extends Controller
{
    /**
     * List order untuk driver
     */
    public function index()
    {
        /** @var \App\Models\Driver $driver */
        $driver = Auth::guard('driver')->user();

        $orders = Pesanan::where('driver_id', $driver->id)
            ->whereIn('status', ['pending', 'accepted'])
            ->orderBy('created_at', 'asc')
            ->get();

        return view('driver.orders', compact('orders'));
    }

    /**
     * Driver menerima order
     * → saldo driver otomatis bertambah
     */
    public function accept($id)
    {
        /** @var \App\Models\Driver $driver */
        $driver = Auth::guard('driver')->user();

        if ($driver->online != 1) {
            return back()->with('error', 'Driver harus online.');
        }

        DB::transaction(function () use ($driver, $id) {

            // Lock order agar tidak direbut driver lain
            $order = Pesanan::lockForUpdate()
                ->where('id', $id)
                ->where('driver_id', $driver->id)
                ->where('status', 'pending')
                ->firstOrFail();

            // Update status order
            $order->update([
                'status'        => 'accepted',
                'user_notified' => 1,
            ]);

            // Ambil / buat wallet driver
            $wallet = Wallet::firstOrCreate(
                [
                    'owner_type' => \App\Models\Driver::class,
                    'owner_id'   => $driver->id,
                ],
                [
                    'balance'  => 0,
                    'currency' => 'IDR',
                ]
            );

            // Tambah saldo driver (DOMAIN LOGIC)
            $wallet->credit(
            $order->price,
            'order_income',
            'ORDER-' . $order->id,
            'Pendapatan dari pesanan #' . $order->id
        );
            

            // Driver jadi busy
            $driver->update([
                'work_status' => 'busy',
            ]);
        });

        return redirect()
            ->route('driver.orders')
            ->with('success', 'Pesanan diterima. Saldo bertambah.');
    }

    /**
     * Driver menyelesaikan order
     */
    public function complete($id)
    {
        /** @var \App\Models\Driver $driver */
        $driver = Auth::guard('driver')->user();

        $order = Pesanan::where('id', $id)
            ->where('driver_id', $driver->id)
            ->where('status', 'accepted')
            ->firstOrFail();

        $order->update([
            'status' => 'completed',
        ]);

        // Jika tidak ada order aktif → available
        $hasActiveOrder = Pesanan::where('driver_id', $driver->id)
            ->where('status', 'accepted')
            ->exists();

        if (!$hasActiveOrder) {
            $driver->update([
                'work_status' => 'available',
            ]);
        }

        return redirect()
            ->route('driver.orders')
            ->with('success', 'Pesanan diselesaikan.');
    }

    /**
     * Map pickup untuk driver
     */
    public function pickupMap($id)
    {
        /** @var \App\Models\Driver $driver */
        $driver = Auth::guard('driver')->user();

        $order = Pesanan::where('id', $id)
            ->where('driver_id', $driver->id)
            ->where('status', 'accepted')
            ->firstOrFail();

        return view('driver.pickup-map', compact('order'));
    }
}