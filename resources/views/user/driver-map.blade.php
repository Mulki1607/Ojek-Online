@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">

    {{-- HEADER --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white tracking-tight">
            Lokasi Driver
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            {{ $driver->name }}
        </p>
    </div>

    {{-- INFO KENDARAAN --}}
    @if($driver->kendaraan)
    <div class="mb-6 bg-gray-900/70 backdrop-blur
                border border-gray-800 rounded-2xl p-5">

        <h4 class="text-sm font-semibold text-gray-300 mb-3">
            Kendaraan Driver
        </h4>

        <div class="flex items-center justify-between">
            <div>
                <p class="text-white font-semibold">
                    {{ $driver->kendaraan->Merk }}
                </p>
                <p class="text-sm text-gray-400">
                    {{ $driver->kendaraan->Tipe }} • {{ $driver->kendaraan->Warna }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Plat: {{ $driver->kendaraan->Plat_Nomor }}
                </p>
            </div>

            <span class="px-3 py-1 text-xs rounded-full
                         bg-gray-800 text-gray-300">
                Kendaraan
            </span>
        </div>
    </div>
    @endif

    {{-- MAP --}}
    <div class="w-full h-[420px] rounded-2xl overflow-hidden
                border border-gray-800 shadow mb-8">
        <iframe
            width="100%"
            height="420"
            style="border:0"
            loading="lazy"
            allowfullscreen
            src="https://www.google.com/maps?q={{ $driver->lat }},{{ $driver->lng }}&hl=id&z=15&output=embed">
        </iframe>
    </div>

    {{-- ACTION --}}
    <form method="POST" action="{{ route('user.order.create') }}">
        @csrf

        <input type="hidden" name="driver_id" value="{{ $driver->id }}">
        <input type="hidden" name="pickup_lat" value="5.1829">
        <input type="hidden" name="pickup_lng" value="97.1397">

        <button
            class="w-full py-3 rounded-xl font-semibold text-white
                   bg-emerald-700 hover:bg-emerald-800 transition">
            Pesan Driver Ini
        </button>
    </form>

    {{-- BACK --}}
    <div class="mt-6 text-center">
        <a href="{{ route('user.nearby') }}"
           class="text-sm text-gray-400 hover:text-white transition">
            ← Kembali ke daftar driver
        </a>
    </div>

</div>
@endsection