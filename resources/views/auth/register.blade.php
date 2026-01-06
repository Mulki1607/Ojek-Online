@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md
                bg-white/90 backdrop-blur
                shadow-xl rounded-2xl p-10">

        {{-- TITLE --}}
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">
            Daftar Akun
        </h2>

        <p class="text-gray-500 text-center mb-8">
            Pilih jenis akun yang ingin Anda buat
        </p>

        {{-- OPTIONS --}}
        <div class="space-y-4">

            {{-- USER --}}
            <a href="{{ route('user.register') }}"
               class="group flex items-center justify-between
                      bg-blue-600 hover:bg-blue-700
                      text-white py-4 px-5 rounded-xl
                      font-semibold transition">

                <span>Daftar sebagai User</span>
                <span class="text-xl group-hover:translate-x-1 transition">→</span>
            </a>

            {{-- DRIVER --}}
            <a href="{{ route('driver.register') }}"
               class="group flex items-center justify-between
                      bg-green-600 hover:bg-green-700
                      text-white py-4 px-5 rounded-xl
                      font-semibold transition">

                <span>Daftar sebagai Driver</span>
                <span class="text-xl group-hover:translate-x-1 transition">→</span>
            </a>
        </div>

        {{-- FOOTER --}}
        <div class="text-center text-sm text-gray-500 mt-8">
            Sudah punya akun?
            <a href="{{ route('login.select') }}"
               class="text-blue-600 font-semibold hover:underline">
                Login
            </a>
        </div>

    </div>
</div>
@endsection