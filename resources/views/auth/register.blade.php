@extends('layouts.main')

@section('content')
<div class="flex justify-center mt-20">
    <div class="bg-white shadow-lg rounded-lg p-10 w-96">

        <h2 class="text-2xl font-bold mb-6 text-center">Daftar Akun</h2>

        <p class="text-gray-600 text-center mb-6">Buat akun sebagai:</p>

        <div class="space-y-4">
            <a href="/register/user"
               class="block text-center bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700">
               Daftar sebagai User
            </a>

            <a href="/register/driver"
               class="block text-center bg-green-600 text-white py-3 rounded-lg hover:bg-green-700">
               Daftar sebagai Driver
            </a>
        </div>

        <div class="text-center text-sm text-gray-500 mt-6">
            Sudah punya akun?
            <a href="/login" class="text-blue-600 hover:underline">Login</a>
        </div>

    </div>
</div>
@endsection
