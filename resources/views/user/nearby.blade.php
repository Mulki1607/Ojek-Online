@extends('layouts.main')

@section('content')

@php
    // Ambil data pesanan dari session
    $order = session('order_data');
@endphp

<div class="max-w-lg mx-auto mt-12 bg-white shadow-lg p-8 rounded">

    <h2 class="text-2xl font-bold mb-4 text-center">Driver Terdekat</h2>

    @if(!$order)
        <div class="text-center text-gray-600">
            Data pesanan tidak ditemukan.
        </div>
        <a href="{{ route('user.order.select') }}" 
           class="block text-center mt-4 text-blue-600 hover:underline">
            Buat Pesanan Baru
        </a>
        @endif

    {{-- DATA PESANAN --}}
    <div class="mb-6">
        <p class="font-semibold">Titik Jemput:</p>
        <p class="mb-2">{{ $order['pickup'] }}</p>

        <p class="font-semibold">Tujuan:</p>
        <p class="mb-2">{{ $order['destination'] }}</p>

        <p class="font-semibold">Catatan:</p>
        <p class="mb-2">{{ $order['note'] ?? '-' }}</p>

        <p class="font-semibold">Estimasi Harga:</p>
        <p class="text-lg font-bold text-green-700 mb-4">
            Rp {{ number_format($order['estimated_price']) }}
        </p>
    </div>

    <h3 class="text-xl font-semibold mb-3">Pilih Driver</h3>

    @foreach($drivers as $d)
        <div class="border p-4 rounded mb-4 shadow-sm bg-gray-50">

            <div class="flex justify-between">
                <div>
                    <p class="text-lg font-bold">{{ $d->nama }}</p>
                    <p class="text-gray-600 text-sm">Kendaraan: {{ $d->jenis_kendaraan }}</p>
                    <p class="text-gray-600 text-sm">Jarak: {{ rand(1,5) }} km</p>
                </div>
                <form action="{{ route('user.order.submit') }}" method="POST">
                     @csrf
                    <input type="hidden" name="driver_id" value="{{ $driver->id }}">
    
                    <button class="px-3 py-2 bg-blue-600 text-white rounded">
                        Pilih Driver
                    </button>
                </form>
            </div>

        </div>
    @endforeach

</div>

@endsection
