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
                        bg-blue-600/20 flex items-center justify-center
                        text-3xl text-blue-400">
                👤
            </div>

            <h2 class="text-2xl font-bold text-white">
                Daftar sebagai User
            </h2>

            <p class="text-sm text-gray-400 mt-1">
                Buat akun untuk mulai menggunakan layanan
            </p>
        </div>

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
            <div class="mb-4 rounded-xl
                        bg-green-600/20 border border-green-500/30
                        text-green-300 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div class="mb-4 rounded-xl
                        bg-red-600/20 border border-red-500/30
                        text-red-300 px-4 py-3 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST"
              action="{{ route('user.register.submit') }}"
              class="space-y-4">
            @csrf

            {{-- NAME --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Nama Lengkap
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       placeholder="Nama sesuai identitas"
                       class="w-full px-4 py-3 rounded-xl
                              bg-gray-900/60 border border-white/10
                              text-white placeholder-gray-500
                              focus:ring-2 focus:ring-blue-600
                              focus:outline-none">
            </div>

            {{-- EMAIL --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Email
                </label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       required
                       placeholder="email@example.com"
                       class="w-full px-4 py-3 rounded-xl
                              bg-gray-900/60 border border-white/10
                              text-white placeholder-gray-500
                              focus:ring-2 focus:ring-blue-600
                              focus:outline-none">
            </div>

            {{-- PHONE --}}
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">
                    Nomor HP
                </label>
                <input type="text"
                       name="phone"
                       value="{{ old('phone') }}"
                       required
                       placeholder="08xxxxxxxxxx"
                       class="w-full px-4 py-3 rounded-xl
                              bg-gray-900/60 border border-white/10
                              text-white placeholder-gray-500
                              focus:ring-2 focus:ring-blue-600
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
                       placeholder="Minimal 6 karakter"
                       class="w-full px-4 py-3 rounded-xl
                              bg-gray-900/60 border border-white/10
                              text-white placeholder-gray-500
                              focus:ring-2 focus:ring-blue-600
                              focus:outline-none">
            </div>

            {{-- SUBMIT --}}
            <button type="submit"
                    class="w-full py-3 rounded-xl
                           bg-blue-600 hover:bg-blue-700
                           text-white font-semibold
                           transition shadow-lg">
                Daftar Akun
            </button>
        </form>

        {{-- FOOTER --}}
        <div class="text-center text-sm text-gray-400 mt-6">
            Sudah punya akun?
            <a href="{{ route('user.login') }}"
               class="text-blue-400 font-semibold hover:underline">
                Login di sini
            </a>
        </div>

    </div>
</div>
@endsection