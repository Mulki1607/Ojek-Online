<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    // ==================================================
    // TAMPILKAN SEMUA WALLET
    // ==================================================
    public function index()
    {
        return response()->json(Wallet::all(), 200);
    }

    // ==================================================
    // DETAIL WALLET USER
    // ==================================================
    public function show($user_id)
    {
        $wallet = Wallet::where('user_id', $user_id)->firstOrFail();

        return response()->json($wallet, 200);
    }

    // ==================================================
    // WALLET TIDAK BOLEH DIBUAT MANUAL
    // ==================================================
    public function store(Request $request)
    {
        return response()->json([
            'error' => 'Wallet tidak dapat dibuat secara manual. Wallet dibuat otomatis saat user registrasi.'
        ], 403);
    }

    // ==================================================
    // UPDATE SALDO TIDAK BOLEH MANUAL
    // ==================================================
    public function update(Request $request, $id)
    {
        return response()->json([
            'error' => 'Saldo tidak bisa diupdate manual. Gunakan Topup/Withdraw.'
        ], 403);
    }

    // ==================================================
    // WALLET TIDAK BOLEH DIHAPUS
    // ==================================================
    public function destroy($id)
    {
        return response()->json([
            'error' => 'Wallet tidak boleh dihapus.'
        ], 403);
    }
}
