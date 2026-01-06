@extends('layouts.main')

@section('hideWalletIcon')
@endsection

@section('content')
<div class="max-w-3xl mx-auto mt-16 px-4">

    {{-- HEADER --}}
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-white">
            Dompet Saya
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            Kelola saldo dan riwayat transaksi
        </p>
    </div>

    {{-- SALDO --}}
    <div class="mb-6 rounded-2xl
                bg-gray-900/80 backdrop-blur
                border border-gray-800
                shadow-lg p-6">

        <p class="text-sm text-gray-400">
            Saldo Saat Ini
        </p>

        <p class="mt-2 text-3xl font-semibold text-green-400">
            Rp {{ number_format($wallet->balance, 0, ',', '.') }}
        </p>
    </div>

    {{-- TOP UP --}}
    <form method="POST"
          action="{{ route('user.wallet.topup') }}"
          class="mb-6 rounded-2xl
                 bg-gray-900/80 backdrop-blur
                 border border-gray-800
                 shadow-lg p-6">
        @csrf

        <label class="block text-sm text-gray-300 mb-2">
            Top Up Saldo
        </label>

        <input type="number"
               name="amount"
               min="1000"
               placeholder="Minimal 1.000"
               class="w-full bg-gray-800 border border-gray-700
                      text-gray-200 rounded-lg px-4 py-2
                      focus:outline-none focus:ring-2 focus:ring-green-700 mb-4">

        <button class="w-full py-2.5 rounded-lg
                       bg-green-700 hover:bg-green-800
                       text-white font-medium transition">
            Top Up
        </button>
    </form>

    {{-- RIWAYAT --}}
    <div class="rounded-2xl
                bg-gray-900/80 backdrop-blur
                border border-gray-800
                shadow-lg p-6">

        <h3 class="text-sm font-semibold text-gray-300 mb-4">
            Riwayat Transaksi
        </h3>

        @forelse($wallet->transactions->sortByDesc('created_at') as $trx)
            <div class="flex justify-between items-center
                        py-2 border-b border-gray-800 last:border-0">

                <span class="text-xs text-gray-400">
                    {{ strtoupper($trx->type) }}
                </span>

                <span class="text-sm
                    {{ $trx->amount >= 0 ? 'text-green-400' : 'text-red-400' }}">
                    Rp {{ number_format(abs($trx->amount), 0, ',', '.') }}
                </span>
            </div>
        @empty
            <p class="text-sm text-gray-500">
                Belum ada transaksi
            </p>
        @endforelse

    </div>

</div>
@endsection