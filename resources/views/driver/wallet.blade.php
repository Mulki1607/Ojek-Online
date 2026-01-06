@extends('layouts.driver')

@section('content')
<div class="max-w-4xl mx-auto mt-12 px-4 space-y-8">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Dompet Driver
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            Kelola saldo dan riwayat pendapatan Anda
        </p>
    </div>

    {{-- SALDO --}}
    <div class="rounded-2xl
                bg-slate-900/80 backdrop-blur
                border border-white/10
                shadow-xl p-6">

        <p class="text-sm text-gray-400">
            Saldo Tersedia
        </p>

        <p class="mt-2 text-4xl font-semibold text-green-400 tracking-wide">
            Rp {{ number_format($wallet->balance, 0, ',', '.') }}
        </p>

        <p class="text-xs text-gray-500 mt-2">
            Saldo bertambah otomatis saat pesanan diterima
        </p>
    </div>

    {{-- WITHDRAW --}}
    <div class="rounded-2xl
                bg-slate-900/80 backdrop-blur
                border border-white/10
                shadow-xl p-6">

        <h3 class="text-sm font-semibold text-gray-300 mb-4">
            Penarikan Saldo
        </h3>

        <form method="POST"
              action="{{ route('driver.wallet.withdraw') }}"
              class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs text-gray-400 mb-1">
                    Jumlah Penarikan
                </label>

                <input type="number"
                       name="amount"
                       min="1000"
                       required
                       placeholder="Minimal Rp 1.000"
                       class="w-full bg-slate-800
                              border border-white/10
                              text-gray-200 rounded-xl
                              px-4 py-2
                              focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            <button
                class="w-full py-2.5 rounded-xl
                       bg-red-600 hover:bg-red-700
                       text-white font-semibold transition">
                Tarik Saldo
            </button>
        </form>
    </div>

    {{-- RIWAYAT --}}
    <div class="rounded-2xl
                bg-slate-900/80 backdrop-blur
                border border-white/10
                shadow-xl p-6">

        <h3 class="text-sm font-semibold text-gray-300 mb-4">
            Riwayat Transaksi
        </h3>

        <div class="divide-y divide-white/10">
            @forelse($wallet->transactions->sortByDesc('created_at') as $trx)
                <div class="flex justify-between items-center py-3">

                    <div>
                        <p class="text-xs font-medium text-gray-300 tracking-wide">
                            {{ strtoupper($trx->type) }}
                        </p>
                        <p class="text-[11px] text-gray-500">
                            {{ $trx->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <div class="text-sm font-semibold
                        {{ $trx->amount >= 0 ? 'text-green-400' : 'text-red-400' }}">
                        Rp {{ number_format(abs($trx->amount), 0, ',', '.') }}
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500 text-center py-6">
                    Belum ada transaksi
                </p>
            @endforelse
        </div>
    </div>

</div>
@endsection