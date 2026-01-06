@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">

    {{-- HEADER --}}
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-white tracking-tight">
            Driver Terdekat
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            Pilih driver berdasarkan jarak dan kendaraan
        </p>
    </div>

    {{-- ACTIONS --}}
    <div class="flex flex-wrap gap-3 mb-8">
        <a href="{{ route('user.pickup.map') }}"
           class="px-4 py-2 rounded-lg text-sm
                  bg-gray-900 border border-gray-700
                  text-gray-200 hover:border-emerald-600 hover:text-white
                  transition">
            📍 Pilih Lokasi Jemput
        </a>

        <button onclick="cariDriver()"
                class="px-4 py-2 rounded-lg text-sm
                       bg-emerald-700 hover:bg-emerald-800
                       text-white transition">
            📡 Cari via GPS
        </button>
    </div>

    {{-- LIST DRIVER --}}
    @if(isset($drivers) && count($drivers))
        <div class="space-y-4">

            @foreach($drivers as $d)
            <div class="bg-gray-900/70 backdrop-blur
                        border border-gray-800 rounded-2xl
                        p-5 flex justify-between items-center gap-4
                        hover:border-emerald-600 transition">

                {{-- INFO DRIVER --}}
                <div class="space-y-1">
                    <p class="font-semibold text-lg text-white">
                        {{ $d->name }}
                    </p>

                    {{-- KENDARAAN --}}
                    @if($d->kendaraan)
                        <div class="flex items-center gap-2 text-sm text-gray-300">
                            <span class="px-2 py-0.5 rounded bg-gray-800 text-xs">
                                {{ $d->kendaraan->Tipe }}
                            </span>
                            <span>
                                {{ $d->kendaraan->Merk }} • {{ $d->kendaraan->Warna }}
                            </span>
                        </div>

                        <p class="text-xs text-gray-500">
                            Plat: {{ $d->kendaraan->Plat_Nomor }}
                        </p>
                    @else
                        <p class="text-xs text-red-400">
                            Kendaraan belum diisi
                        </p>
                    @endif

                    {{-- JARAK --}}
                    <p class="text-xs text-gray-500 mt-2">
                        📏 {{ number_format($d->distance ?? 0, 2) }} km
                    </p>
                </div>

                {{-- ACTION --}}
                <a href="{{ route('user.driver.map', $d->id) }}"
                   class="shrink-0 px-5 py-2 rounded-lg text-sm font-semibold
                          bg-emerald-700 hover:bg-emerald-800
                          text-white transition">
                    Pilih
                </a>

            </div>
            @endforeach

        </div>
    @else
        <div class="text-sm text-gray-400 bg-gray-900/60 border border-gray-800 rounded-xl p-4">
            Belum ada driver tersedia.  
            Pilih lokasi jemput atau aktifkan GPS.
        </div>
    @endif

</div>

<script>
function cariDriver() {
    if (!navigator.geolocation) {
        alert("Browser tidak mendukung GPS");
        return;
    }

    navigator.geolocation.getCurrentPosition(function (position) {
        fetch("{{ route('user.find.drivers') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                lat: position.coords.latitude,
                lng: position.coords.longitude
            })
        }).then(() => window.location.reload());
    }, function () {
        alert("Izin lokasi ditolak");
    });
}
</script>
@endsection