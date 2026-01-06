@extends('layouts.driver')

@section('content')
<div class="max-w-4xl mx-auto px-4 mt-10 space-y-8">

    {{-- ================= HEADER ================= --}}
    <div>
        <h2 class="text-3xl font-bold text-gray-800">
            Data Kendaraan
        </h2>
        <p class="text-gray-500 mt-1">
            Informasi kendaraan yang digunakan untuk menerima pesanan
        </p>
    </div>

    {{-- ================= ALERT ================= --}}
    @if(session('success'))
        <div class="rounded-xl bg-green-50 border border-green-200
                    text-green-700 px-5 py-4 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ================= FORM CARD ================= --}}
    <div class="bg-white rounded-2xl shadow p-6 md:p-8">

        <form method="POST"
              action="{{ route('driver.kendaraan.save') }}"
              class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            {{-- PLAT --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Plat Nomor
                </label>
                <input
                    type="text"
                    name="Plat_Nomor"
                    value="{{ old('Plat_Nomor') }}"
                    placeholder="Contoh: BL 1234 XX"
                    class="w-full border rounded-xl px-4 py-3
                           focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
            </div>

            {{-- TIPE --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Tipe Kendaraan
                </label>
                <select
                    name="Tipe"
                    class="w-full border rounded-xl px-4 py-3
                           focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
                    <option value="">Pilih Tipe</option>
                    <option value="Motor">Motor</option>
                    <option value="Mobil">Mobil</option>
                </select>
            </div>

            {{-- MERK --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Merk Kendaraan
                </label>
                <input
                    type="text"
                    name="Merk"
                    placeholder="Contoh: Honda, Yamaha, Toyota"
                    class="w-full border rounded-xl px-4 py-3
                           focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
            </div>

            {{-- WARNA --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Warna Kendaraan
                </label>
                <input
                    type="text"
                    name="Warna"
                    placeholder="Contoh: Hitam, Putih, Merah"
                    class="w-full border rounded-xl px-4 py-3
                           focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
            </div>

            {{-- ACTION --}}
            <div class="md:col-span-2 flex flex-col md:flex-row gap-3 mt-2">
                <button
                    class="bg-blue-600 text-white px-8 py-3 rounded-xl
                           font-semibold hover:bg-blue-700 transition">
                    Simpan Kendaraan
                </button>

                <a href="{{ route('driver.dashboard') }}"
                   class="px-8 py-3 rounded-xl border
                          text-gray-600 hover:bg-gray-100 text-center">
                    Kembali ke Dashboard
                </a>
            </div>
        </form>

    </div>

</div>
@endsection