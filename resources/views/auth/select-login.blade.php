@extends('main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="bg-white shadow-lg p-8 rounded-lg w-full max-w-md text-center">

        <h2 class="text-2xl font-bold mb-6">Login Sebagai</h2>

        <a href="{{ route('user.login') }}"
           class="block w-full bg-blue-600 text-white py-3 rounded mb-4 hover:bg-blue-700">
            User
        </a>

        <a href="{{ route('driver.login') }}"
           class="block w-full bg-green-600 text-white py-3 rounded hover:bg-green-700">
            Driver
        </a>

        <p class="mt-6 text-gray-500 text-sm">
            Belum punya akun?
            <a href="{{ route('register.select') }}" class="text-blue-600 underline">
                Daftar
            </a>
        </p>

    </div>

</div>
@endsection
