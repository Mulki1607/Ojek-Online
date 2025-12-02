@extends('layouts.main')

@section('content')
<div class="max-w-lg mx-auto mt-12 bg-white shadow-lg p-8 rounded">

    <h2 class="text-2xl font-bold mb-4 text-center">
        Buat Pesanan – 
        @if($type === 'ride') Antar Jemput
        @elseif($type === 'delivery') Kirim Barang
        @else Pesan & Belanja
        @endif
    </h2>

    <form action="{{ route('user.order.submit') }}" method="POST">
        @csrf

        <input type="hidden" name="type" value="{{ $type }}">

        {{-- TITIK JEMPUT --}}
        <label class="font-semibold">Titik Jemput</label>
        <input type="text" name="pickup" required
               placeholder="Contoh: Jalan Merdeka No. 12"
               class="w-full px-3 py-2 border rounded mb-4">

        {{-- TITIK TUJUAN --}}
        <label class="font-semibold">Tujuan</label>
        <input type="text" name="destination" required
               placeholder="Contoh: Mall Lhokseumawe"
               class="w-full px-3 py-2 border rounded mb-4">

        {{-- CATATAN OPSIONAL --}}
        <label class="font-semibold">Catatan (Opsional)</label>
        <textarea name="note"
                  placeholder="Contoh: Tolong jemput di depan masjid"
                  class="w-full px-3 py-2 border rounded mb-4"></textarea>

        {{-- ESTIMASI HARGA (STATIC LOGIC DI FRONTEND DULU) --}}
        <label class="font-semibold">Estimasi Harga</label>
        <input type="text" id="priceEst" 
               class="w-full px-3 py-2 border rounded mb-4 bg-gray-100" 
               value="—" readonly>

        {{-- SCRIPT HITUNG HARGA SEDERHANA --}}
        <script>
            document.querySelector("input[name='destination']").addEventListener('input', function() {
                // Untuk versi awal, harga random sederhana dulu
                let price = Math.floor(Math.random() * 15000) + 5000;
                document.getElementById("priceEst").value = "Rp " + price.toLocaleString();
            });
        </script>

        <button class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700 mb-3">
            Cari Driver Terdekat
        </button>

    </form>

    <a href="{{ route('user.home') }}"
       class="block text-center text-gray-600 hover:text-gray-800 mt-3">
        Kembali
    </a>

</div>
@endsection
