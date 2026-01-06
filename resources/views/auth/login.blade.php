@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        {{-- HEADER --}}
        <div class="text-center mb-8">
            <div class="text-4xl mb-3">🔐</div>
            <h2 class="text-2xl font-bold text-gray-800">
                Selamat Datang
            </h2>
            <p class="text-gray-500 text-sm mt-1">
                Masuk untuk melanjutkan ke aplikasi
            </p>
        </div>

        {{-- LOGIN OPTIONS --}}
        <div class="space-y-4">

            {{-- USER LOGIN --}}
            <a href="{{ route('user.login') }}"
               class="group flex items-center justify-between w-full px-5 py-4
                      bg-blue-600 text-white rounded-xl
                      hover:bg-blue-700 transition">

                <div>
                    <p class="font-semibold">Login sebagai User</p>
                    <p class="text-xs text-blue-100">
                        Pesan ojek, kirim barang, pesan makanan
                    </p>
                </div>

                <span class="text-xl group-hover:translate-x-1 transition">
                    →
                </span>
            </a>

            {{-- DRIVER LOGIN --}}
            <a href="{{ route('driver.login') }}"
               class="group flex items-center justify-between w-full px-5 py-4
                      bg-green-600 text-white rounded-xl
                      hover:bg-green-700 transition">

                <div>
                    <p class="font-semibold">Login sebagai Driver</p>
                    <p class="text-xs text-green-100">
                        Terima order & mulai menghasilkan
                    </p>
                </div>

                <span class="text-xl group-hover:translate-x-1 transition">
                    →
                </span>
            </a>

        </div>

        {{-- DIVIDER --}}
        <div class="flex items-center gap-3 my-8">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="text-xs text-gray-400">atau</span>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        {{-- REGISTER --}}
        <div class="text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register.select') }}"
               class="font-semibold text-blue-600 hover:underline">
                Daftar sekarang
            </a>
        </div>

    </div>
</div>
@endsection