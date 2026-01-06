@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">

    {{-- HEADER --}}
    <div class="mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-white tracking-tight">
            Halo, {{ auth()->user()->name }}
        </h1>
        <p class="text-gray-400 mt-2">
            Mau ke mana hari ini? Pilih layanan di bawah untuk mulai.
        </p>
    </div>

    {{-- QUICK ACTION --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- BUAT PESANAN --}}
        <a href="{{ route('user.order.select') }}"
           class="group bg-gray-900/70 backdrop-blur
                  border border-gray-800 rounded-2xl p-6
                  hover:border-emerald-600 hover:bg-gray-900
                  transition-all duration-200">

            <div class="flex items-center gap-5">
                <div class="w-14 h-14 flex items-center justify-center
                            rounded-xl bg-emerald-900/40
                            text-emerald-300 text-2xl">
                    🚕
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-white
                               group-hover:text-emerald-400 transition">
                        Buat Pesanan
                    </h3>
                    <p class="text-sm text-gray-400 mt-1">
                        Ride, delivery, atau belanja
                    </p>
                </div>
            </div>
        </a>

        {{-- DRIVER TERDEKAT --}}
        <a href="{{ route('user.nearby') }}"
           class="group bg-gray-900/70 backdrop-blur
                  border border-gray-800 rounded-2xl p-6
                  hover:border-emerald-600 hover:bg-gray-900
                  transition-all duration-200">

            <div class="flex items-center gap-5">
                <div class="w-14 h-14 flex items-center justify-center
                            rounded-xl bg-emerald-900/40
                            text-emerald-300 text-2xl">
                    📍
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-white
                               group-hover:text-emerald-400 transition">
                        Driver Terdekat
                    </h3>
                    <p class="text-sm text-gray-400 mt-1">
                        Lihat driver di sekitar Anda
                    </p>
                </div>
            </div>
        </a>

        {{-- RIWAYAT --}}
        <a href="{{ route('user.orders') }}"
           class="group bg-gray-900/70 backdrop-blur
                  border border-gray-800 rounded-2xl p-6
                  hover:border-emerald-600 hover:bg-gray-900
                  transition-all duration-200">

            <div class="flex items-center gap-5">
                <div class="w-14 h-14 flex items-center justify-center
                            rounded-xl bg-emerald-900/40
                            text-emerald-300 text-2xl">
                    🧾
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-white
                               group-hover:text-emerald-400 transition">
                        Riwayat Pesanan
                    </h3>
                    <p class="text-sm text-gray-400 mt-1">
                        Lihat pesanan sebelumnya
                    </p>
                </div>
            </div>
        </a>

    </div>

</div>
@endsection