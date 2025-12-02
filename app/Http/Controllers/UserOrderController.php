<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;


class UserOrderController extends Controller
{
    public function makeOrder(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
        ]);

        // pastikan user login
        $user = Auth::user();

        $driver = Driver::findOrFail($request->driver_id);

        // Buat pesanan
        $order = Pesanan::create([
            'user_id'   => $user->id,
            'driver_id' => $driver->id,
            'status'    => 'pending',
        ]);

        return redirect()->route('user.orders')
                         ->with('success', 'Pesanan berhasil dibuat!');
    }
    public function orderForm($type)
    {
        // Validasi tipe layanan
        $allowed = ['ride', 'delivery', 'shopping'];

        if (!in_array($type, $allowed)) {
            abort(404);
        }

        return view('user.order-form', [
            'type' => $type
        ]);
    }
    public function submitOrder(Request $request)
{
    $request->validate([
        'type'        => 'required',
        'pickup'      => 'required',
        'destination' => 'required',
        'note'        => 'nullable|string',
    ]);

    // Sementara belum pakai harga real → dummy harga
    $price = rand(5000, 20000);

    // Belum simpan ke database karena nanti akan masuk ke fitur "Cari Driver"
    // Untuk sekarang tampilkan halaman driver terdekat

    return redirect()
        ->route('user.nearby')
        ->with('order_data', [
            'type'        => $request->type,
            'pickup'      => $request->pickup,
            'destination' => $request->destination,
            'note'        => $request->note,
            'estimated_price' => $price
        ]);
}
public function chooseDriver(Request $request)
{
    $request->validate([
        'driver_id' => 'required|exists:drivers,id'
    ]);

    $order = session('order_data');

    if (!$order) {
        return redirect()->route('user.order.select')->with('error', 'Pesanan tidak ditemukan.');
    }

    // Simpan ke database
    $pesanan = Pesanan::create([
        'user_id'    => auth::id(),
        'driver_id'  => $request->driver_id,
        'pickup'     => $order['pickup'],
        'destination'=> $order['destination'],
        'note'       => $order['note'] ?? null,
        'price'      => $order['estimated_price'],
        'status'     => 'pending'
    ]);

    // Hapus session
    session()->forget('order_data');

    // Redirect user
    return redirect()->route('user.orders')
                     ->with('success', 'Pesanan berhasil dibuat!');
}

}
