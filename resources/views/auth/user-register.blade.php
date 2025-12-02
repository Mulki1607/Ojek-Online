@extends('layouts.main')

@section('content')
<div class="flex justify-center mt-20">
    <div class="bg-white shadow-lg rounded-lg p-10 w-96">

        <h2 class="text-2xl font-bold mb-4 text-center">Daftar User</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.register.submit') }}">
            @csrf

            <label class="font-semibold">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full px-3 py-2 border rounded mb-4">

            <label class="font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-3 py-2 border rounded mb-4">

            <label class="font-semibold">Nomor HP</label>
            <input type="text" name="phone" value="{{ old('phone') }}" required
                   class="w-full px-3 py-2 border rounded mb-4">

            <label class="font-semibold">Password</label>
            <input type="password" name="password" required
                   class="w-full px-3 py-2 border rounded mb-4">

            <button class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm mt-4 text-gray-600">
            Sudah punya akun?
            <a href="{{ route('user.login') }}" class="text-blue-600 hover:underline">Login</a>
        </p>

    </div>
</div>
@endsection
