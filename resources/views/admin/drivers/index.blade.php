@extends('layouts.admin')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h2 class="text-2xl font-semibold text-white">
            Driver Management
        </h2>
        <p class="text-sm text-gray-400 mt-1">
            Monitoring status driver, kendaraan, dan aktivitas
        </p>
    </div>

    {{-- LIST DRIVER --}}
    <div class="space-y-4">

        @foreach($drivers as $driver)
        <div class="bg-slate-900/70 backdrop-blur
                    border border-white/10
                    rounded-2xl p-6
                    flex flex-col md:flex-row
                    md:items-start md:justify-between
                    gap-6">

            {{-- INFO --}}
            <div class="space-y-2">

                <p class="text-lg font-semibold text-white">
                    {{ $driver->name }}
                </p>

                {{-- ONLINE STATUS --}}
                <div class="text-sm flex items-center gap-2">
                    <span class="text-gray-400">Online:</span>

                    @if($driver->online)
                        <span class="px-2 py-0.5 rounded-full text-xs
                                     bg-green-500/20 text-green-400">
                            YA
                        </span>
                    @else
                        <span class="px-2 py-0.5 rounded-full text-xs
                                     bg-gray-500/20 text-gray-400">
                            TIDAK
                        </span>
                    @endif
                </div>

                {{-- WORK STATUS --}}
                <div class="text-sm flex items-center gap-2">
                    <span class="text-gray-400">Status Kerja:</span>

                    @if($driver->work_status === 'available')
                        <span class="px-2 py-0.5 rounded-full text-xs
                                     bg-blue-500/20 text-blue-400">
                            AVAILABLE
                        </span>
                    @elseif($driver->work_status)
                        <span class="px-2 py-0.5 rounded-full text-xs
                                     bg-orange-500/20 text-orange-400">
                            BUSY
                        </span>
                    @else
                        <span class="px-2 py-0.5 rounded-full text-xs
                                     bg-gray-500/20 text-gray-400">
                            -
                        </span>
                    @endif
                </div>

                {{-- VEHICLE --}}
                <div class="pt-2 text-sm">
                    <p class="text-gray-400 mb-1">
                        Kendaraan:
                    </p>

                    @if($driver->kendaraan)
                        <p class="text-white font-medium">
                            {{ $driver->kendaraan->Tipe }}
                            — {{ $driver->kendaraan->Merk }}
                            ({{ $driver->kendaraan->Warna }})
                        </p>
                        <p class="text-xs text-gray-500">
                            Plat: {{ $driver->kendaraan->Plat_Nomor }}
                        </p>
                    @else
                        <p class="text-xs text-red-400">
                            Belum diisi
                        </p>
                    @endif
                </div>
            </div>

            {{-- ACTION --}}
            <div class="flex flex-col gap-3 text-sm min-w-[180px]">

                <form method="POST"
                      action="{{ route('admin.drivers.toggle', $driver->id) }}">
                    @csrf

                    <button
                        class="w-full px-4 py-2 rounded-xl font-semibold transition
                        {{ $driver->online
                            ? 'bg-red-600 hover:bg-red-700 text-white'
                            : 'bg-green-600 hover:bg-green-700 text-white' }}">
                        {{ $driver->online ? 'Nonaktifkan' : 'Aktifkan' }}
                    </button>
                </form>

                <a href="{{ route('admin.drivers.orders', $driver->id) }}"
                   class="w-full text-center px-4 py-2 rounded-xl
                          bg-indigo-600 hover:bg-indigo-700
                          text-white font-semibold transition">
                    Lihat Pesanan
                </a>
            </div>

        </div>
        @endforeach

    </div>
</div>
@endsection