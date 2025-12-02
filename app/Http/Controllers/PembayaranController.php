<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Tampilkan semua pembayaran
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        return response()->json($pembayaran);
    }

    /**
     * Simpan pembayaran baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pesanan_id'    => 'required|exists:pesanans,id',
            'user_id'       => 'required|exists:users,id',
            'driver_id'     => 'nullable|exists:drivers,id',
            'metode'        => 'required|string|in:cash,wallet,transfer',
            'jumlah'        => 'required|numeric|min:0',
            'status'        => 'nullable|string|in:pending,paid,failed,refunded',
            'tanggal_bayar' => 'nullable|date',
        ]);

        $pembayaran = Pembayaran::create([
            'pesanan_id'    => $validated['pesanan_id'],
            'user_id'       => $validated['user_id'],
            'driver_id'     => $validated['driver_id'] ?? null,
            'metode'        => $validated['metode'],
            'jumlah'        => $validated['jumlah'],
            'status'        => $validated['status'] ?? 'pending',
            'tanggal_bayar' => $validated['tanggal_bayar'] ?? now(),
        ]);

        return response()->json([
            'message' => 'Pembayaran berhasil dibuat',
            'pembayaran' => $pembayaran
        ], 201);
    }

    /**
     * Tampilkan pembayaran berdasarkan ID
     */
    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return response()->json($pembayaran);
    }

    /**
     * Update pembayaran
     */
    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $validated = $request->validate([
            'driver_id'     => 'sometimes|exists:drivers,id',
            'metode'        => 'sometimes|string|in:cash,wallet,transfer',
            'jumlah'        => 'sometimes|numeric|min:0',
            'status'        => 'sometimes|string|in:pending,paid,failed,refunded',
            'tanggal_bayar' => 'sometimes|date',
        ]);

        $pembayaran->update($validated);

        return response()->json([
            'message' => 'Pembayaran berhasil diperbarui',
            'pembayaran' => $pembayaran
        ]);
    }

    /**
     * Hapus pembayaran
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return response()->json(['message' => 'Pembayaran berhasil dihapus']);
    }
}
