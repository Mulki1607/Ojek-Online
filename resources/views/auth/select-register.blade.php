@extends('main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="bg-white shadow-lg p-8 rounded-lg w-full max-w-md text-center">

        <h2 class="text-2xl font-bold mb-6">Daftar Sebagai</h2>

        <a href="{{ route('user.register') }}"
           class="block w-full bg-blue-600 text-white py-3 rounded mb-4 hover:bg-blue-700">
            User
        </a>

        <a href="{{ route('driver.register') }}"
           class="block w-full bg-green-600 text-white py-3 rounded hover:bg-green-700">
            Driver
        </a>

        <p class="mt-6 text-gray-500 text-sm">
            Sudah punya akun?
            <a href="{{ route('login.select') }}" class="text-blue-600 underline">
                Login
            </a>
        </p>

    </div>

</div>
@endsection
