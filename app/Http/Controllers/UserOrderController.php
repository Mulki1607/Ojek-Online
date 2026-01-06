<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pesanan;
use App\Models\Wallet;

class UserOrderController extends Controller
{
    /* ==============================
     | FORM ORDER
     ============================== */
    public function orderForm($type)
    {
        $allowed = ['ride', 'delivery', 'shopping'];

        if (!in_array($type, $allowed)) {
            abort(404);
        }

        return view('user.order-form', compact('type'));
    }

    /* ==============================
     | SUBMIT ORDER (SESSION)
     ============================== */
    public function submitOrder(Request $request)
    {
        $request->validate([
            'type'        => 'required',
            'pickup'      => 'required|string',
            'destination' => 'required|string',
            'note'        => 'nullable|string',
        ]);

        session([
            'order_data' => [
                'type'        => $request->type,
                'pickup'      => $request->pickup,
                'destination' => $request->destination,
                'note'        => $request->note,
                'price'       => rand(5000, 20000),
            ]
        ]);

        return redirect()->route('user.nearby');
    }

    /* ==============================
     | CREATE FINAL ORDER
     ============================== */
    public function create(Request $request)
    {
        $request->validate([
            'driver_id'  => 'required|exists:drivers,id',
            'pickup_lat' => 'required|numeric',
            'pickup_lng' => 'required|numeric',
        ]);

        $orderData = session('order_data');

        if (!$orderData) {
            return redirect()
                ->route('user.home')
                ->with('error', 'Data pesanan tidak ditemukan.');
        }
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 🔑 AMBIL / BUAT WALLET USER (ANTI NULL)
        $wallet = Wallet::getOrCreateFor($user);

        if ($wallet->balance < $orderData['price']) {
            return redirect()
                ->route('user.wallet')
                ->with('error', 'Saldo tidak cukup. Silakan top up.');
        }

        DB::transaction(function () use ($wallet, $orderData, $request, $user) {

            // ===============================
            // POTONG SALDO USER
            // ===============================
            $wallet->debit(
                $orderData['price'],
                'order_payment',
                'Pembayaran pesanan'
            );

            // ===============================
            // BUAT PESANAN
            // ===============================
            Pesanan::create([
                'user_id'         => $user->id,
                'driver_id'       => $request->driver_id,
                'pickup_location' => $orderData['pickup'],
                'destination'     => $orderData['destination'],
                'pickup_lat'      => $request->pickup_lat,
                'pickup_lng'      => $request->pickup_lng,
                'pickup_note'     => $orderData['note'] ?? null,
                'price'           => $orderData['price'],
                'status'          => 'pending',
            ]);
        });

        session()->forget('order_data');

        return redirect()
            ->route('user.orders')
            ->with('success', 'Pesanan berhasil dibuat.');
    }

    /* ==============================
     | RIWAYAT PESANAN
     ============================== */
    public function orderHistory()
    {
        $orders = Pesanan::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('user.orders', compact('orders'));
    }
}