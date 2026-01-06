@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto mt-10">

    <h2 class="text-2xl font-bold mb-4">
        Pilih Lokasi Jemput
    </h2>

    <p class="text-gray-600 mb-4">
        Klik peta untuk menentukan titik jemput.
    </p>

    {{-- MAP --}}
    <div id="map" class="w-full h-[450px] rounded shadow"></div>

    {{-- INFO --}}
    <div class="mt-4 text-sm text-gray-700">
        Lokasi dipilih:
        <span id="latlng" class="font-semibold text-blue-700">
            Belum dipilih
        </span>
    </div>

    {{-- ACTION --}}
    <div class="mt-6 flex flex-wrap gap-3">

        <button id="saveBtn"
            class="bg-green-600 text-white px-6 py-3 rounded disabled:opacity-50"
            disabled>
            Gunakan Lokasi Ini
        </button>

        {{-- GOOGLE MAPS PREVIEW --}}
        <a id="gmapsBtn"
           href="#"
           target="_blank"
           class="bg-blue-600 text-white px-6 py-3 rounded hidden">
            Lihat di Google Maps
        </a>

        <a href="{{ route('user.nearby') }}"
           class="px-6 py-3 rounded border">
            Batal
        </a>
    </div>

</div>

{{-- LEAFLET --}}
<link
  rel="stylesheet"
  href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let map = L.map('map').setView([5.18, 97.14], 13); // default Aceh

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap'
}).addTo(map);

let marker = null;
let selectedLat = null;
let selectedLng = null;

map.on('click', function (e) {
    selectedLat = e.latlng.lat;
    selectedLng = e.latlng.lng;

    if (marker) {
        marker.setLatLng(e.latlng);
    } else {
        marker = L.marker(e.latlng).addTo(map);
    }

    document.getElementById('latlng').innerText =
        selectedLat.toFixed(6) + ', ' + selectedLng.toFixed(6);

    // enable buttons
    document.getElementById('saveBtn').disabled = false;

    // update Google Maps link
    const gmapsUrl = `https://www.google.com/maps?q=${selectedLat},${selectedLng}`;
    const gmapsBtn = document.getElementById('gmapsBtn');
    gmapsBtn.href = gmapsUrl;
    gmapsBtn.classList.remove('hidden');
});

document.getElementById('saveBtn').addEventListener('click', function () {

    fetch("{{ route('user.find.drivers') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            lat: selectedLat,
            lng: selectedLng
        })
    })
    .then(res => res.json())
    .then(() => {
        window.location.href = "{{ route('user.nearby') }}";
    });

});
</script>
@endsection