@extends('layouts.guest')

@section('title', 'ILS OJOL')

@section('content')

{{-- =========================================================
| HERO
========================================================= --}}
<section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800">

    {{-- BACKGROUND GLOW (NON INTERACTIVE) --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-32 -left-32 w-[500px] h-[500px]
                    bg-blue-600/20 rounded-full blur-3xl"></div>

        <div class="absolute top-1/3 right-0 w-[400px] h-[400px]
                    bg-green-600/10 rounded-full blur-3xl"></div>
    </div>

    {{-- CONTENT --}}
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-28
                grid grid-cols-1 md:grid-cols-2 gap-14 items-center">

        {{-- TEXT --}}
        <div class="text-white">
            <span class="inline-block mb-4 px-4 py-1 rounded-full
                         bg-black/40 border border-white/10
                         text-sm text-gray-300">
                Platform Transportasi & Pengiriman
            </span>

            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                Semua Kebutuhan Mobilitas
                <span class="block text-green-400">
                    Dalam Satu Aplikasi
                </span>
            </h1>

            <p class="text-lg text-gray-300 mb-10 max-w-xl">
                Antar jemput, kirim barang, hingga pesan makanan.
                Cepat, aman, dan transparan — dirancang untuk kebutuhan modern.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('register.select') }}"
                   class="px-7 py-3 rounded-xl bg-green-600 hover:bg-green-700
                          text-white font-semibold shadow-lg transition">
                    Mulai Sekarang
                </a>

                <a href="{{ route('login.select') }}"
                   class="px-7 py-3 rounded-xl border border-white/30
                          text-white hover:bg-white hover:text-slate-900 transition">
                    Login
                </a>
            </div>
        </div>

        {{-- HERO ILLUSTRATION --}}
        <div class="hidden md:flex justify-center">
            <div class="relative w-[380px] h-[320px]
                        bg-white/5 backdrop-blur-xl
                        border border-white/10
                        rounded-3xl shadow-2xl
                        flex items-center justify-center">

                {{-- ICON MOTOR --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-40 h-40 text-green-500/90"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 16a3 3 0 106 0 3 3 0 00-6 0zm10 0a3 3 0 106 0 3 3 0 00-6 0zM5 16h4l2-5h5l2 5h-1" />
                </svg>

                {{-- BORDER GLOW --}}
                <div class="absolute inset-0 rounded-3xl ring-1 ring-white/10 pointer-events-none"></div>
            </div>
        </div>

    </div>
</section>

{{-- =========================================================
| SERVICES (DARK)
========================================================= --}}
<section id="layanan" class="py-24 bg-gray-900">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-white">
                Layanan Unggulan
            </h2>
            <p class="text-gray-400 mt-3">
                Solusi lengkap untuk mobilitas dan pengiriman harian
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            {{-- CARD --}}
            <div class="relative bg-gray-800/70 backdrop-blur
                        border border-white/10 rounded-2xl
                        shadow-lg hover:shadow-2xl hover:-translate-y-1
                        transition-all p-8">

                <div class="absolute inset-x-0 top-0 h-1 bg-blue-600"></div>
                <div class="text-4xl mb-5 text-blue-400">🚗</div>
                <h3 class="text-xl font-semibold mb-3 text-white">
                    Ojek Online
                </h3>
                <p class="text-gray-400 text-sm">
                    Antar jemput cepat dengan driver terverifikasi.
                </p>
            </div>

            <div class="relative bg-gray-800/70 backdrop-blur
                        border border-white/10 rounded-2xl
                        shadow-lg hover:shadow-2xl hover:-translate-y-1
                        transition-all p-8">

                <div class="absolute inset-x-0 top-0 h-1 bg-green-600"></div>
                <div class="text-4xl mb-5 text-green-400">📦</div>
                <h3 class="text-xl font-semibold mb-3 text-white">
                    Kurir & Pengiriman
                </h3>
                <p class="text-gray-400 text-sm">
                    Kirim barang dengan tracking jelas & aman.
                </p>
            </div>

            <div class="relative bg-gray-800/70 backdrop-blur
                        border border-white/10 rounded-2xl
                        shadow-lg hover:shadow-2xl hover:-translate-y-1
                        transition-all p-8">

                <div class="absolute inset-x-0 top-0 h-1 bg-purple-600"></div>
                <div class="text-4xl mb-5 text-purple-400">🍔</div>
                <h3 class="text-xl font-semibold mb-3 text-white">
                    Pesan Makanan
                </h3>
                <p class="text-gray-400 text-sm">
                    Merchant lokal pilihan, cepat & praktis.
                </p>
            </div>

        </div>
    </div>
</section>

{{-- =========================================================
| CTA
========================================================= --}}
<section class="py-24 bg-gradient-to-br from-gray-900 to-slate-800 text-white">
    <div class="max-w-4xl mx-auto text-center px-6">

        <h2 class="text-3xl font-bold mb-5">
            Siap Menggunakan ILS OJOL?
        </h2>

        <p class="text-gray-300 mb-10">
            Transportasi & pengiriman dengan standar modern dan profesional.
        </p>

        <a href="{{ route('register.select') }}"
           class="inline-block px-10 py-4 rounded-xl
                  bg-green-600 hover:bg-green-700
                  text-white font-semibold shadow-lg transition">
            Buat Akun Gratis
        </a>
        <p class="text-gray-300 mb-10">
            Bergabung sekarang dan nikmati layanan transportasi & pengiriman
            dengan pengalaman modern dan profesional.
        </p>
    </div>
</section>
@endsection