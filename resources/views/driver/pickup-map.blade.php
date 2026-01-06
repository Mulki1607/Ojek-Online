@extends('layouts.driver')

@section('content')
<div class="max-w-6xl mx-auto px-4 mt-10">

    {{-- HEADER --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Lokasi Jemput User
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Arahkan kendaraan ke titik jemput yang ditentukan
        </p>
    </div>

    {{-- MAP CARD --}}
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        {{-- MAP --}}
        <div id="map" class="w-full h-[420px]"></div>

        {{-- FOOTER ACTION --}}
        <div class="flex flex-col md:flex-row
                    justify-between items-center
                    gap-4 px-6 py-4 border-t">

            <div class="text-sm text-gray-600">
                📍 Koordinat:
                <span class="font-medium">
                    {{ number_format($order->pickup_lat, 5) }},
                    {{ number_format($order->pickup_lng, 5) }}
                </span>
            </div>

            <a href="{{ route('driver.orders') }}"
               class="inline-flex items-center gap-2
                      px-6 py-2.5 rounded-xl
                      border border-gray-300
                      text-gray-700 text-sm font-medium
                      hover:bg-gray-100 transition">
                ← Kembali ke Pesanan
            </a>
        </div>

    </div>

</div>

{{-- LEAFLET --}}
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const pickupLat = {{ json_encode($order->pickup_lat) }};
    const pickupLng = {{ json_encode($order->pickup_lng) }};

    const map = L.map('map').setView([pickupLat, pickupLng], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(map);

    L.marker([pickupLat, pickupLng])
        .addTo(map)
        .bindPopup('<b>Lokasi Jemput User</b>')
        .openPopup();
</script>
@endsection