<div class="mt-4 rounded-2xl
            bg-gray-900/70 backdrop-blur
            border border-gray-800 p-5">

    <h4 class="text-sm font-semibold text-gray-300 mb-3">
        Kendaraan Driver
    </h4>

    @if($kendaraan)
        <div class="flex items-center justify-between">

            <div>
                <p class="text-white font-semibold leading-tight">
                    {{ $kendaraan->Merk }}
                </p>
                <p class="text-sm text-gray-400">
                    {{ $kendaraan->Tipe }} • {{ $kendaraan->Warna }}
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Plat: {{ $kendaraan->Plat_Nomor }}
                </p>
            </div>

            <span class="px-3 py-1 rounded-full text-xs
                         bg-gray-800 text-gray-300">
                Kendaraan
            </span>
        </div>
    @else
        <p class="text-sm text-gray-500 italic">
            Data kendaraan belum tersedia
        </p>
    @endif
</div>