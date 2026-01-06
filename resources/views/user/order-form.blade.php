@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto mt-14 px-4">

    <div class="rounded-2xl
                bg-gray-900/80 backdrop-blur
                border border-gray-800 shadow-xl p-8">

        {{-- HEADER --}}
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-semibold text-white">
                Buat Pesanan
            </h2>
            <p class="text-sm text-gray-400 mt-1">
                @if($type === 'ride') Antar Jemput
                @elseif($type === 'delivery') Kirim Barang
                @else Pesan & Belanja
                @endif
            </p>
        </div>

        <form action="{{ route('user.order.submit') }}" method="POST" class="space-y-5">
            @csrf

            {{-- TIPE --}}
            <input type="hidden" name="type" value="{{ $type }}">

            {{-- TITIK JEMPUT --}}
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Titik Jemput
                </label>
                <input type="text"
                       name="pickup"
                       required
                       placeholder="Contoh: Depan Masjid Raya"
                       class="w-full rounded-lg
                              bg-gray-800 border border-gray-700
                              text-white placeholder-gray-500
                              px-4 py-2.5
                              focus:outline-none focus:ring-2 focus:ring-green-600">
            </div>

            {{-- TUJUAN --}}
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Tujuan
                </label>
                <input type="text"
                       name="destination"
                       id="destinationInput"
                       required
                       placeholder="Contoh: Mall Lhokseumawe"
                       class="w-full rounded-lg
                              bg-gray-800 border border-gray-700
                              text-white placeholder-gray-500
                              px-4 py-2.5
                              focus:outline-none focus:ring-2 focus:ring-green-600">
            </div>

            {{-- CATATAN --}}
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Catatan (Opsional)
                </label>
                <textarea name="note"
                          rows="3"
                          placeholder="Contoh: Jemput di gerbang samping"
                          class="w-full rounded-lg
                                 bg-gray-800 border border-gray-700
                                 text-white placeholder-gray-500
                                 px-4 py-2.5
                                 focus:outline-none focus:ring-2 focus:ring-green-600"></textarea>
            </div>

            {{-- ESTIMASI --}}
            <div>
                <label class="block text-sm text-gray-300 mb-1">
                    Estimasi Harga
                </label>
                <input type="text"
                       id="priceEst"
                       readonly
                       value="—"
                       class="w-full rounded-lg
                              bg-gray-700/50 border border-gray-700
                              text-gray-300
                              px-4 py-2.5">
            </div>

            {{-- ACTION --}}
            <button type="submit"
                    class="w-full mt-2
                           bg-green-700 hover:bg-green-800
                           text-white font-medium
                           py-3 rounded-xl transition">
                Cari Driver Terdekat
            </button>
        </form>

        <a href="{{ route('user.home') }}"
           class="block text-center text-sm text-gray-400 hover:text-white mt-6">
            ← Kembali
        </a>
    </div>

</div>

{{-- ESTIMASI FRONTEND --}}
<script>
document.getElementById('destinationInput').addEventListener('input', function () {
    let price = Math.floor(Math.random() * 15000) + 5000;
    document.getElementById('priceEst').value =
        'Rp ' + price.toLocaleString('id-ID');
});
</script>
@endsection