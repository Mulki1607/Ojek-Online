<?php

namespace App\Http\Controllers;

use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class WalletTransactionController extends Controller
{
    // ==================================================
    // TAMPILKAN SEMUA TRANSAKSI (ADMIN)
    // ==================================================
    public function index()
    {
        $transactions = WalletTransaction::with('user')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'message' => 'Daftar semua transaksi wallet',
            'data' => $transactions
        ], 200);
    }

    // ==================================================
    // DETAIL TRANSAKSI
    // ==================================================
    public function show($id)
    {
        $transaction = WalletTransaction::with('user')->findOrFail($id);

        return response()->json([
            'message' => 'Detail transaksi wallet',
            'data' => $transaction
        ], 200);
    }

    // ==================================================
    // TAMPILKAN TRANSAKSI BERDASARKAN USER
    // ==================================================
    public function userTransactions($userId)
    {
        $transactions = WalletTransaction::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'message' => 'Daftar transaksi user',
            'data' => $transactions
        ], 200);
    }
}
