@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4
            bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900">

    <div class="w-full max-w-md
                bg-white/5 backdrop-blur-xl
                border border-white/10
                rounded-2xl shadow-2xl
                p-8">

        {{-- HEADER --}}
        <div class="text-center mb-8">
            <div class="mx-auto mb-4 w-16 h-16 rounded-full
                        bg-green-600/20 flex items-center justify-center
                        text-3xl text-green-400">
                🛵
            </div>

            <h2 class="text-2xl font-bold text-white">
                Login Driver
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Masuk untuk mulai menerima pesanan
            </p>
        </div>

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="mb-4 rounded-xl
                        bg-red-600/20 border border-red-500/30
                        text-red-300 px-4 py-3 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST"
              action="{{ route('driver.login.submit') }}"
              class="space-y-4">
            @csrf

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Email
                </label>
                <input type="email"
                       name="email"
                       required
                       placeholder="email@contoh.com"
                       class="w-full px-4 py-3 rounded-xl
                              bg-gray-900/60 border border-white/10
                              text-white placeholder-gray-500
                              focus:ring-2 focus:ring-green-600
                              focus:outline-none">
            </div>

            {{-- PASSWORD --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Password
                </label>
                <input type="password"
                       name="password"
                       required
                       placeholder="••••••••"
                       class="w-full px-4 py-3 rounded-xl
                              bg-gray-900/60 border border-white/10
                              text-white placeholder-gray-500
                              focus:ring-2 focus:ring-green-600
                              focus:outline-none">
            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                    class="w-full py-3 rounded-xl
                           bg-green-600 hover:bg-green-700
                           text-white font-semibold
                           transition shadow-lg">
                Login Driver
            </button>
        </form>

        {{-- FOOTER --}}
        <div class="text-center text-sm text-gray-400 mt-6">
            Belum punya akun?
            <a href="{{ route('driver.register') }}"
               class="text-green-400 font-semibold hover:underline">
                Daftar Driver
            </a>
        </div>

    </div>
</div>
@endsection