<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Tampilkan semua pesanan.
     */
    public function index()
    {
        $pesanans = Pesanan::all();
        return response()->json($pesanans);
    }

    /**
     * Tambah pesanan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'          => 'required|exists:users,id',
            'driver_id'        => 'nullable|exists:drivers,id',
            'pickup_location'  => 'required|string|max:255',
            'destination'      => 'required|string|max:255',
            'harga'            => 'required|numeric',
            'status'           => 'nullable|string|in:pending,accepted,on_progress,completed,cancelled',
        ]);

        $pesanan = Pesanan::create([
            'user_id'          => $validated['user_id'],
            'driver_id'        => $validated['driver_id'] ?? null,
            'pickup_location'  => $validated['pickup_location'],
            'destination'      => $validated['destination'],
            'harga'            => $validated['harga'],
            'status'           => $validated['status'] ?? 'pending',
        ]);

        return response()->json([
            'message' => 'Pesanan berhasil dibuat',
            'pesanan' => $pesanan
        ], 201);
    }

    /**
     * Tampilkan pesanan berdasarkan ID.
     */
    public function show($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return response()->json($pesanan);
    }

    /**
     * Update pesanan.
     */
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $validated = $request->validate([
            'driver_id'        => 'sometimes|exists:drivers,id',
            'pickup_location'  => 'sometimes|string|max:255',
            'destination'      => 'sometimes|string|max:255',
            'harga'            => 'sometimes|numeric',
            'status'           => 'sometimes|string|in:pending,accepted,on_progress,completed,cancelled',
        ]);

        $pesanan->update($validated);

        return response()->json([
            'message' => 'Pesanan berhasil diperbarui',
            'pesanan' => $pesanan
        ]);
    }

    /**
     * Hapus pesanan.
     */
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return response()->json(['message' => 'Pesanan berhasil dihapus']);
    }
}
