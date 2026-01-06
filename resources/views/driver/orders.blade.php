@extends('layouts.driver')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4 space-y-8">

    {{-- HEADER --}}
    <div>
        <h2 class="text-3xl font-bold text-white">
            Pesanan Masuk
        </h2>
        <p class="text-gray-400 mt-1">
            Pesanan yang tersedia dan sedang kamu tangani
        </p>
    </div>

    {{-- FLASH --}}
    @if(session('success'))
        <div class="bg-green-500/20 border border-green-500/30
                    text-green-300 px-4 py-3 rounded-xl text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500/20 border border-red-500/30
                    text-red-300 px-4 py-3 rounded-xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- LIST --}}
    @if($orders->count())
        <div class="space-y-5">

            @foreach($orders as $order)
                <div
                    class="bg-slate-800/70 backdrop-blur
                           border border-white/10
                           rounded-2xl shadow-xl
                           p-6
                           flex flex-col md:flex-row
                           md:items-center md:justify-between gap-6">

                    {{-- INFO --}}
                    <div class="space-y-2">
                        <div class="flex items-center gap-3">
                            <p class="text-lg font-semibold text-white">
                                Order #{{ $order->id }}
                            </p>

                            {{-- STATUS --}}
                            @if($order->status === 'pending')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                             bg-orange-500/20 text-orange-300">
                                    MENUNGGU
                                </span>
                            @elseif($order->status === 'accepted')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                             bg-blue-500/20 text-blue-300">
                                    DITERIMA
                                </span>
                            @elseif($order->status === 'completed')
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                             bg-green-500/20 text-green-300">
                                    SELESAI
                                </span>
                            @endif
                        </div>

                        <div class="text-sm text-gray-400">
                            <p>User ID:
                                <span class="text-gray-200">
                                    {{ $order->user_id }}
                                </span>
                            </p>
                            <p>{{ $order->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    {{-- ACTION --}}
                    <div class="flex flex-wrap gap-3">

                        {{-- TERIMA --}}
                        @if($order->status === 'pending')
                            <form method="POST"
                                  action="{{ route('driver.orders.accept', $order->id) }}">
                                @csrf
                                <button
                                    class="px-5 py-3 rounded-xl
                                           bg-green-600 hover:bg-green-700
                                           text-white font-semibold transition">
                                    Terima
                                </button>
                            </form>
                        @endif

                        {{-- AKTIF --}}
                        @if($order->status === 'accepted')
                            <a href="{{ route('driver.pickup.map', $order->id) }}"
                               class="px-5 py-3 rounded-xl
                                      bg-blue-600 hover:bg-blue-700
                                      text-white font-semibold transition">
                                Lokasi Jemput
                            </a>

                            <form method="POST"
                                  action="{{ route('driver.orders.complete', $order->id) }}">
                                @csrf
                                <button
                                    class="px-5 py-3 rounded-xl
                                           bg-green-600 hover:bg-green-700
                                           text-white font-semibold transition">
                                    Selesaikan
                                </button>
                            </form>
                        @endif

                        {{-- SELESAI --}}
                        @if($order->status === 'completed')
                            <span class="text-green-400 font-semibold text-sm">
                                ✔ Pesanan selesai
                            </span>
                        @endif

                    </div>
                </div>
            @endforeach

        </div>
    @else
        <div class="bg-slate-800/70 backdrop-blur
                    border border-white/10
                    rounded-2xl shadow-xl p-8 text-center">
            <p class="text-gray-400 mb-4">
                Tidak ada pesanan masuk saat ini
            </p>
            <a href="{{ route('driver.dashboard') }}"
               class="inline-block px-6 py-3 rounded-xl
                      bg-blue-600 hover:bg-blue-700
                      text-white font-semibold transition">
                Kembali ke Dashboard
            </a>
        </div>
    @endif

</div>
@endsection