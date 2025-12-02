<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    /**
     * Tampilkan semua data withdraw
     */
    public function index()
    {
        $withdraw = Withdraw::all();
        return response()->json($withdraw);
    }

    /**
     * Simpan permintaan withdraw baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'wallet_id'    => 'required|exists:wallets,id',
            'jumlah'       => 'required|numeric|min:1000',
            'metode'       => 'required|string|in:bank,ewallet,transfer',
            'status'       => 'nullable|string|in:pending,sukses,gagal',
            'tanggal'      => 'nullable|date',
        ]);

        $withdraw = Withdraw::create([
            'user_id'      => $validated['user_id'],
            'wallet_id'    => $validated['wallet_id'],
            'jumlah'       => $validated['jumlah'],
            'metode'       => $validated['metode'],
            'status'       => $validated['status'] ?? 'pending',
            'tanggal'      => $validated['tanggal'] ?? now(),
        ]);

        return response()->json([
            'message' => 'Permintaan withdraw berhasil dibuat',
            'withdraw' => $withdraw
        ], 201);
    }

    /**
     * Tampilkan data withdraw berdasarkan ID
     */
    public function show($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        return response()->json($withdraw);
    }

    /**
     * Update data withdraw
     */
    public function update(Request $request, $id)
    {
        $withdraw = Withdraw::findOrFail($id);

        $validated = $request->validate([
            'jumlah'       => 'sometimes|numeric|min:1000',
            'metode'       => 'sometimes|string|in:bank,ewallet,transfer',
            'status'       => 'sometimes|string|in:pending,sukses,gagal',
            'tanggal'      => 'sometimes|date',
        ]);

        $withdraw->update($validated);

        return response()->json([
            'message' => 'Withdraw berhasil diperbarui',
            'withdraw' => $withdraw
        ]);
    }

    /**
     * Hapus data withdraw
     */
    public function destroy($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        $withdraw->delete();

        return response()->json(['message' => 'Withdraw berhasil dihapus']);
    }
}
