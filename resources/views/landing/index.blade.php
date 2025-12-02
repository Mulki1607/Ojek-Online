@extends('layouts.main')

@section('content')

<!-- HERO SECTION -->
<section class="container mx-auto px-6 py-20 text-center">
    <h2 class="text-4xl font-bold mb-4 text-gray-900">
        Transportasi & Pengiriman dalam Satu Aplikasi
    </h2>

    <p class="text-lg text-gray-600 mb-6">
        Mudahkan aktivitas harian dengan layanan ojek online, antar barang, hingga pesan makan .
    </p>

    <div class="space-x-4">
        <a href="/register" class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
            Daftar Sekarang
        </a>
        <a href="/login" class="px-6 py-3 border rounded-lg hover:bg-gray-100">
            Login
        </a>
    </div>
</section>

<!-- FITUR LAYANAN -->
<section id="layanan" class="py-16 bg-gray-100">
    <div class="container mx-auto px-6">

        <h3 class="text-3xl font-semibold text-center mb-10">Layanan Kami</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-white shadow p-6 rounded-lg text-center">
                <h4 class="text-xl font-bold mb-2">Ojek Motor</h4>
                <p class="text-gray-600">Layanan transportasi cepat dan terjangkau.</p>
            </div>

            <div class="bg-white shadow p-6 rounded-lg text-center">
                <h4 class="text-xl font-bold mb-2">Kurir</h4>
                <p class="text-gray-600">Kirim barang dalam kota dengan cepat.</p>
            </div>

            <div class="bg-white shadow p-6 rounded-lg text-center">
                <h4 class="text-xl font-bold mb-2">Pesan Makanan</h4>
                <p class="text-gray-600">Antar makanan dari restoran favorit.</p>
            </div>

        </div>
    </div>
</section>

@endsection
