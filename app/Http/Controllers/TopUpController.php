<?php

namespace App\Http\Controllers;

use App\Models\TopUp;
use Illuminate\Http\Request;

class TopUpController extends Controller
{
    /**
     * Tampilkan semua data top up
     */
    public function index()
    {
        $topup = TopUp::all();
        return response()->json($topup);
    }

    /**
     * Simpan data top up baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'wallet_id'    => 'required|exists:wallets,id',
            'jumlah'       => 'required|numeric|min:1000',
            'metode'       => 'required|string|in:bank,ewallet,pulsa,transfer',
            'status'       => 'nullable|string|in:pending,sukses,gagal',
            'tanggal'      => 'nullable|date',
        ]);

        $topup = TopUp::create([
            'user_id'      => $validated['user_id'],
            'wallet_id'    => $validated['wallet_id'],
            'jumlah'       => $validated['jumlah'],
            'metode'       => $validated['metode'],
            'status'       => $validated['status'] ?? 'pending',
            'tanggal'      => $validated['tanggal'] ?? now(),
        ]);

        return response()->json([
            'message' => 'Top up berhasil dibuat',
            'topup' => $topup
        ], 201);
    }

    /**
     * Tampilkan top up tertentu
     */
    public function show($id)
    {
        $topup = TopUp::findOrFail($id);
        return response()->json($topup);
    }

    /**
     * Update data top up
     */
    public function update(Request $request, $id)
    {
        $topup = TopUp::findOrFail($id);

        $validated = $request->validate([
            'jumlah'       => 'sometimes|numeric|min:1000',
            'metode'       => 'sometimes|string|in:bank,ewallet,pulsa,transfer',
            'status'       => 'sometimes|string|in:pending,sukses,gagal',
            'tanggal'      => 'sometimes|date',
        ]);

        $topup->update($validated);

        return response()->json([
            'message' => 'Top up berhasil diperbarui',
            'topup' => $topup
        ]);
    }

    /**
     * Hapus data top up
     */
    public function destroy($id)
    {
        $topup = TopUp::findOrFail($id);
        $topup->delete();

        return response()->json(['message' => 'Top up berhasil dihapus']);
    }
}
