<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;

class WalletController extends Controller
{
    /* ================= HELPER ================= */
    private function wallet($owner): Wallet
    {
        return Wallet::firstOrCreate(
            [
                'owner_type' => get_class($owner),
                'owner_id'   => $owner->id,
            ],
            [
                'balance'  => 0,
                'currency' => 'IDR',
            ]
        );
    }

    /* ================= USER WALLET ================= */
    public function userWallet()
    {
        $wallet = $this->wallet(Auth::user())->load('transactions');

        return view('user.wallet', compact('wallet'));
    }

    public function topup(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $wallet = $this->wallet(Auth::user());

        $wallet->credit(
            $request->amount,
            'topup',
            null,
            'Top up saldo'
        );

        return back()->with('success', 'Top up berhasil');
    }

    /* ================= DRIVER WALLET ================= */
    public function driverWallet()
    {
        $wallet = $this->wallet(Auth::guard('driver')->user())
            ->load('transactions');

        return view('driver.wallet', compact('wallet'));
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        try {
            $wallet = $this->wallet(Auth::guard('driver')->user());

            $wallet->debit(
                $request->amount,
                'withdraw',
                null,
                'Penarikan saldo'
            );

            return back()->with('success', 'Withdraw berhasil');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}