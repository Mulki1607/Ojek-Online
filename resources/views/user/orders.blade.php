@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto mt-16 px-4">

    {{-- HEADER --}}
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-white">
            Pesanan Saya
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            Riwayat dan status pesanan Anda
        </p>
    </div>

    {{-- FLASH --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded-lg
                    bg-green-900/40 border border-green-800
                    text-green-300 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('info'))
        <div class="mb-4 px-4 py-3 rounded-lg
                    bg-blue-900/40 border border-blue-800
                    text-blue-300 text-sm">
            {{ session('info') }}
        </div>
    @endif

    {{-- LIST ORDER --}}
    @if($orders->count())
        <div class="space-y-4">

            @foreach($orders as $order)
            <div class="rounded-2xl
                        bg-gray-900/80 backdrop-blur
                        border border-gray-800
                        shadow-lg p-5">

                <div class="flex flex-col md:flex-row md:justify-between gap-4">

                    {{-- INFO --}}
                    <div>
                        <p class="text-sm text-gray-400">
                            Order #{{ $order->id }}
                        </p>

                        <p class="text-white font-medium mt-1">
                            Driver:
                            <span class="text-gray-300">
                                {{ $order->driver->name ?? 'Belum ditentukan' }}
                            </span>
                        </p>

                        {{-- STATUS --}}
                        <div class="mt-3">
                            @if($order->status === 'pending')
                                <span class="px-3 py-1 rounded-full text-xs
                                             bg-yellow-900/40 text-yellow-300 border border-yellow-800">
                                    Menunggu Driver
                                </span>
                            @elseif($order->status === 'accepted')
                                <span class="px-3 py-1 rounded-full text-xs
                                             bg-blue-900/40 text-blue-300 border border-blue-800">
                                    Driver Menuju Lokasi
                                </span>
                            @elseif($order->status === 'completed')
                                <span class="px-3 py-1 rounded-full text-xs
                                             bg-green-900/40 text-green-300 border border-green-800">
                                    Selesai
                                </span>
                            @elseif($order->status === 'expired')
                                <span class="px-3 py-1 rounded-full text-xs
                                             bg-red-900/40 text-red-300 border border-red-800">
                                    Expired
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs
                                             bg-gray-800 text-gray-400 border border-gray-700">
                                    {{ strtoupper($order->status) }}
                                </span>
                            @endif
                        </div>

                        <p class="text-xs text-gray-500 mt-2">
                            Dibuat {{ $order->created_at->diffForHumans() }}
                        </p>
                    </div>

                    {{-- ACTION --}}
                    <div class="text-sm text-gray-400 md:text-right">
                        @if($order->status === 'pending')
                            Menunggu driver menerima
                        @elseif($order->status === 'accepted')
                            Driver sedang menuju lokasi
                        @elseif($order->status === 'completed')
                            ✔ Pesanan selesai
                        @elseif($order->status === 'expired')
                            ✖ Tidak ada respon driver
                        @endif
                    </div>

                </div>

                {{-- RATING --}}
                @if($order->status === 'completed' && !$order->rating)
                <form method="POST"
                      action="{{ route('user.order.rate', $order->id) }}"
                      class="mt-5 pt-4 border-t border-gray-800">
                    @csrf

                    <div class="flex flex-col md:flex-row gap-3 items-center">

                        <select name="rating"
                                required
                                class="bg-gray-800 border border-gray-700
                                       text-gray-200 rounded px-3 py-2 text-sm">
                            <option value="">Rating</option>
                            @for($i=1; $i<=5; $i++)
                                <option value="{{ $i }}">{{ $i }} ★</option>
                            @endfor
                        </select>

                        <textarea name="comment"
                                  placeholder="Komentar (opsional)"
                                  class="flex-1 bg-gray-800 border border-gray-700
                                         text-gray-200 rounded px-3 py-2 text-sm"></textarea>

                        <button class="px-5 py-2 rounded-lg
                                       bg-green-700 hover:bg-green-800
                                       text-white text-sm font-medium transition">
                            Kirim
                        </button>
                    </div>
                </form>
                @endif

            </div>
            @endforeach

        </div>
    @else
        <p class="text-sm text-gray-400">
            Belum ada pesanan.
        </p>
    @endif

</div>
@endsection