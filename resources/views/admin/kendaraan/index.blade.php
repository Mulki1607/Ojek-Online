@extends('layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-6">Data Kendaraan Driver</h2>

<div class="bg-white shadow rounded overflow-x-auto">
<table class="w-full text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2">Driver</th>
            <th>Plat</th>
            <th>Tipe</th>
            <th>Merk</th>
            <th>Warna</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kendaraans as $k)
        <tr class="border-t">
            <td class="px-4 py-2">{{ $k->driver->name }}</td>
            <td>{{ $k->Plat_Nomor }}</td>
            <td>{{ $k->Tipe }}</td>
            <td>{{ $k->Merk }}</td>
            <td>{{ $k->Warna }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection