@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto mt-16 px-4">

    <div class="rounded-2xl
                bg-gray-900/80 backdrop-blur
                border border-gray-800 shadow-xl p-8">

        {{-- HEADER --}}
        <div class="text-center mb-8">
            <h2 class="text-2xl font-semibold text-white">
                Buat Pesanan
            </h2>
            <p class="text-sm text-gray-400 mt-2">
                Pilih layanan yang ingin kamu gunakan
            </p>
        </div>

        {{-- OPTIONS --}}
        <div class="space-y-4">

            {{-- RIDE --}}
            <a href="{{ route('user.order.form', ['type' => 'ride']) }}"
               class="group flex items-center justify-between
                      px-5 py-4 rounded-xl
                      bg-gray-800 border border-gray-700
                      hover:border-green-600 hover:bg-gray-800/70
                      transition">
                <div>
                    <p class="text-white font-medium text-lg">
                        Antar Jemput
                    </p>
                    <p class="text-xs text-gray-400">
                        Perjalanan cepat & aman
                    </p>
                </div>
                <span class="text-green-500 text-xl group-hover:translate-x-1 transition">
                    →
                </span>
            </a>

            {{-- DELIVERY --}}
            <a href="{{ route('user.order.form', ['type' => 'delivery']) }}"
               class="group flex items-center justify-between
                      px-5 py-4 rounded-xl
                      bg-gray-800 border border-gray-700
                      hover:border-green-600 hover:bg-gray-800/70
                      transition">
                <div>
                    <p class="text-white font-medium text-lg">
                        Kirim Barang
                    </p>
                    <p class="text-xs text-gray-400">
                        Dokumen, paket, atau barang
                    </p>
                </div>
                <span class="text-green-500 text-xl group-hover:translate-x-1 transition">
                    →
                </span>
            </a>

            {{-- SHOPPING --}}
            <a href="{{ route('user.order.form', ['type' => 'shopping']) }}"
               class="group flex items-center justify-between
                      px-5 py-4 rounded-xl
                      bg-gray-800 border border-gray-700
                      hover:border-green-600 hover:bg-gray-800/70
                      transition">
                <div>
                    <p class="text-white font-medium text-lg">
                        Pesan & Belanja
                    </p>
                    <p class="text-xs text-gray-400">
                        Titip beli ke driver
                    </p>
                </div>
                <span class="text-green-500 text-xl group-hover:translate-x-1 transition">
                    →
                </span>
            </a>

        </div>

        {{-- BACK --}}
        <a href="{{ route('user.home') }}"
           class="block text-center text-sm text-gray-400 hover:text-white mt-8">
            ← Kembali
        </a>

    </div>

</div>
@endsection