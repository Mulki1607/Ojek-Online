@extends('layouts.main')

@section('content')
<div class="max-w-md mx-auto mt-12 bg-white shadow-lg p-8 rounded">

    <h2 class="text-2xl font-bold mb-5 text-center">Buat Pesanan</h2>

    <p class="text-gray-600 mb-6 text-center">
        Pilih jenis layanan yang ingin kamu gunakan.
    </p>

    <div class="grid grid-cols-1 gap-4">

        {{-- Antar Jemput Orang --}}
        <a href="{{ route('user.order.form', ['type' => 'ride']) }}"
           class="block bg-blue-600 text-white text-center py-4 rounded-lg text-lg font-semibold hover:bg-blue-700 transition">
            Antar Jemput
        </a>

        {{-- Antar Barang --}}
        <a href="{{ route('user.order.form', ['type' => 'delivery']) }}"
           class="block bg-green-600 text-white text-center py-4 rounded-lg text-lg font-semibold hover:bg-green-700 transition">
            Kirim Barang
        </a>

        {{-- Belanja --}}
        <a href="{{ route('user.order.form', ['type' => 'shopping']) }}"
           class="block bg-purple-600 text-white text-center py-4 rounded-lg text-lg font-semibold hover:bg-purple-700 transition">
            Pesan & Belanja
        </a>

    </div>
</div>
@endsection
