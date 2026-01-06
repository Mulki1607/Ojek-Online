@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto mt-6">

    <h2 class="text-2xl font-bold mb-4">
        Detail Driver
    </h2>

    <div class="bg-white rounded shadow p-6 mb-6">
        <p><b>Nama:</b> {{ $driver->name }}</p>
        <p><b>Email:</b> {{ $driver->email }}</p>
        <p><b>Status:</b> {{ $driver->status }}</p>
    </div>

    <div class="bg-white rounded shadow p-6">
        <h3 class="font-semibold mb-3">Data Kendaraan</h3>

        @if($driver->kendaraan)
            <p><b>Tipe:</b> {{ $driver->kendaraan->Tipe }}</p>
            <p><b>Merk:</b> {{ $driver->kendaraan->Merk }}</p>
            <p><b>Warna:</b> {{ $driver->kendaraan->Warna }}</p>
            <p><b>Plat:</b> {{ $driver->kendaraan->Plat_Nomor }}</p>
        @else
            <p class="text-gray-500">
                Driver belum mengisi data kendaraan
            </p>
        @endif
    </div>

</div>
@endsection