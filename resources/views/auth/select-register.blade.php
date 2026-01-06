@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4
            bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">

    <div class="w-full max-w-md
                bg-white/5 backdrop-blur-xl
                border border-white/10
                rounded-2xl shadow-2xl
                p-8 text-center">

        <h2 class="text-2xl font-bold text-white mb-2">
            Buat Akun
        </h2>

        <p class="text-gray-400 mb-8">
            Pilih jenis akun yang ingin kamu gunakan
        </p>

        {{-- USER --}}
        <a href="{{ route('user.register') }}"
           class="block w-full mb-4
                  bg-blue-600 hover:bg-blue-700
                  text-white py-3 rounded-xl
                  font-semibold transition">
            Daftar sebagai User
        </a>

        {{-- DRIVER --}}
        <a href="{{ route('driver.register') }}"
           class="block w-full
                  bg-green-600 hover:bg-green-700
                  text-white py-3 rounded-xl
                  font-semibold transition">
            Daftar sebagai Driver
        </a>

        <p class="mt-8 text-sm text-gray-400">
            Sudah punya akun?
            <a href="{{ route('login.select') }}"
               class="text-green-400 font-semibold hover:underline">
                Login
            </a>
        </p>

    </div>

</div>
@endsection