@extends('layouts.main')

@section('content')
<div class="max-w-2xl mx-auto mt-20 bg-white p-6 shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Selamat Datang, {{ auth()->user()->name }}</h2>

    <p class="text-gray-700 mb-4">
        Anda berhasil login sebagai User.
    </p>

    <div class="grid grid-cols-1 gap-4 mt-4">

        <a href="{{ route('user.order.select') }}"
           class="block bg-blue-600 text-white text-center py-3 rounded hover:bg-blue-700">
            Buat Pesanan
        </a>

        <a href="{{ route('user.nearby') }}"
           class="block bg-green-600 text-white text-center py-3 rounded hover:bg-green-700">
            Driver Terdekat
        </a>

        <a href="{{ route('user.orders') }}"
           class="block bg-gray-800 text-white text-center py-3 rounded hover:bg-gray-900">
            Riwayat Pesanan
        </a>

    </div>
</div>
@endsection
