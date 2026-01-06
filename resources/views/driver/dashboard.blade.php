@extends('layouts.driver')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4 space-y-8">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-white">
                Dashboard Driver
            </h1>
            <p class="text-gray-400 mt-1">
                Selamat datang, {{ auth()->guard('driver')->user()->name }}
            </p>
        </div>

        {{-- STATUS --}}
        <div class="mt-4 md:mt-0">
            <span class="px-5 py-2 rounded-full text-sm font-semibold
                {{ auth()->guard('driver')->user()->online
                    ? 'bg-green-600/20 text-green-400'
                    : 'bg-gray-600/20 text-gray-400' }}">
                ● {{ auth()->guard('driver')->user()->online ? 'ONLINE' : 'OFFLINE' }}
            </span>
        </div>
    </div>

    {{-- ================= STATUS CARD ================= --}}
    <div class="bg-white/5 backdrop-blur-xl
                border border-white/10
                rounded-2xl shadow-xl p-6
                flex flex-col md:flex-row
                items-center justify-between gap-4">

        <div>
            <h3 class="text-lg font-semibold text-white">
                Status Ketersediaan
            </h3>
            <p class="text-sm text-gray-400 mt-1">
                Aktifkan status online untuk menerima pesanan baru
            </p>
        </div>

        <div class="flex gap-3">
            <form method="POST" action="{{ route('driver.toggle.online') }}">
                @csrf
                <button
                    class="px-6 py-3 rounded-xl font-semibold text-white transition
                    {{ auth()->guard('driver')->user()->online
                        ? 'bg-red-600 hover:bg-red-700'
                        : 'bg-green-600 hover:bg-green-700' }}">
                    {{ auth()->guard('driver')->user()->online ? 'Go Offline' : 'Go Online' }}
                </button>
            </form>

            <a href="{{ route('driver.orders') }}"
               class="px-6 py-3 rounded-xl bg-blue-600 text-white
                      font-semibold hover:bg-blue-700 transition">
                Pesanan Masuk
            </a>
        </div>
    </div>

    {{-- ================= VEHICLE CARD ================= --}}
    <div class="bg-white/5 backdrop-blur-xl
                border border-white/10
                rounded-2xl shadow-xl p-6">

        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-white">
                Kendaraan Terdaftar
            </h3>

            <button onclick="toggleForm()"
                class="text-sm text-blue-400 hover:underline">
                {{ auth()->guard('driver')->user()->kendaraan ? 'Ubah Data' : 'Tambah Kendaraan' }}
            </button>
        </div>

        {{-- DISPLAY --}}
        @if(auth()->guard('driver')->user()->kendaraan)
            <div id="vehicleInfo" class="space-y-1 text-gray-200">
                <p class="font-semibold">
                    {{ auth()->guard('driver')->user()->kendaraan->Tipe }}
                </p>
                <p class="text-sm text-gray-400">
                    {{ auth()->guard('driver')->user()->kendaraan->Merk }}
                    · {{ auth()->guard('driver')->user()->kendaraan->Warna }}
                </p>
                <p class="text-xs text-gray-500">
                    Plat Nomor: {{ auth()->guard('driver')->user()->kendaraan->Plat_Nomor }}
                </p>
            </div>
        @else
            <p class="text-sm text-gray-500">
                Data kendaraan belum diisi.
            </p>
        @endif

        {{-- FORM --}}
        <div id="vehicleForm" class="hidden mt-6">
            <form method="POST"
                  action="{{ route('driver.kendaraan.save') }}"
                  class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                @csrf

                <input name="Plat_Nomor" placeholder="Plat Nomor"
                       value="{{ old('Plat_Nomor', auth()->guard('driver')->user()->kendaraan->Plat_Nomor ?? '') }}"
                       class="bg-gray-900 border border-white/10
                              rounded-xl px-4 py-3 text-white"
                       required>

                <select name="Tipe"
                        class="bg-gray-900 border border-white/10
                               rounded-xl px-4 py-3 text-white"
                        required>
                    <option value="">Tipe Kendaraan</option>
                    <option value="Motor">Motor</option>
                    <option value="Mobil">Mobil</option>
                </select>

                <input name="Merk" placeholder="Merk"
                       value="{{ old('Merk', auth()->guard('driver')->user()->kendaraan->Merk ?? '') }}"
                       class="bg-gray-900 border border-white/10
                              rounded-xl px-4 py-3 text-white"
                       required>

                <input name="Warna" placeholder="Warna"
                       value="{{ old('Warna', auth()->guard('driver')->user()->kendaraan->Warna ?? '') }}"
                       class="bg-gray-900 border border-white/10
                              rounded-xl px-4 py-3 text-white"
                       required>

                <div class="md:col-span-2 flex gap-3">
                    <button class="bg-blue-600 px-6 py-3 rounded-xl text-white font-semibold">
                        Simpan
                    </button>
                    <button type="button" onclick="toggleForm()"
                        class="text-gray-400 hover:underline">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
function toggleForm() {
    document.getElementById('vehicleForm').classList.toggle('hidden');
    document.getElementById('vehicleInfo')?.classList.toggle('hidden');
}
</script>
@endsection