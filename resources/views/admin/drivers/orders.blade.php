@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto mt-10 space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-white">
                Pesanan Driver
            </h2>
            <p class="text-sm text-gray-500">
                {{ $driver->name }} · Monitoring aktivitas pesanan
            </p>
        </div>

        <a href="{{ route('admin.drivers.index') }}"
           class="inline-flex items-center gap-2
                  px-4 py-2 rounded-lg
                  bg-gray-800 text-white
                  hover:bg-gray-700 transition text-sm">
            ← Kembali
        </a>
    </div>

    {{-- FILTER --}}
    <form method="GET"
          class="flex flex-wrap gap-3
                 bg-gray-900/90 backdrop-blur
                 border border-gray-800
                 rounded-xl p-4">

        <select name="status"
                class="bg-gray-800 border border-gray-700
                       text-gray-200 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="pending" @selected(request('status')=='pending')>Pending</option>
            <option value="accepted" @selected(request('status')=='accepted')>Accepted</option>
            <option value="completed" @selected(request('status')=='completed')>Completed</option>
        </select>

        <select name="period"
                class="bg-gray-800 border border-gray-700
                       text-gray-200 rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Waktu</option>
            <option value="today" @selected(request('period')=='today')>Hari Ini</option>
            <option value="week" @selected(request('period')=='week')>7 Hari</option>
            <option value="month" @selected(request('period')=='month')>Bulan Ini</option>
        </select>

        <button
            class="px-4 py-2 rounded-lg
                   bg-blue-600 hover:bg-blue-700
                   text-white text-sm font-medium transition">
            Terapkan Filter
        </button>

        <a href="{{ route('admin.drivers.orders', $driver->id) }}"
           class="px-4 py-2 rounded-lg
                  bg-gray-700 hover:bg-gray-600
                  text-white text-sm transition">
            Reset
        </a>
    </form>

    {{-- LIST ORDERS --}}
    @if($orders->count())
        <div class="space-y-4">

            @foreach($orders as $order)
                <div class="bg-gray-900/90 backdrop-blur
                            border border-gray-800
                            rounded-xl p-5
                            flex justify-between items-center">

                    {{-- INFO --}}
                    <div class="space-y-1">
                        <p class="font-semibold text-white">
                            Order #{{ $order->id }}
                        </p>

                        <p class="text-sm text-gray-400">
                            User ID: {{ $order->user_id }}
                        </p>

                        <p class="text-xs text-gray-500">
                            {{ $order->created_at->diffForHumans() }}
                        </p>
                    </div>

                    {{-- STATUS --}}
                    <span class="px-3 py-1.5 rounded-full text-xs font-semibold
                        @if($order->status === 'pending')
                            bg-orange-500/20 text-orange-400
                        @elseif($order->status === 'accepted')
                            bg-blue-500/20 text-blue-400
                        @elseif($order->status === 'completed')
                            bg-green-500/20 text-green-400
                        @else
                            bg-gray-500/20 text-gray-400
                        @endif
                    ">
                        {{ strtoupper($order->status) }}
                    </span>

                </div>
            @endforeach

            {{-- PAGINATION --}}
            <div class="pt-4">
                {{ $orders->links() }}
            </div>

        </div>
    @else
        <div class="bg-gray-900/80 border border-gray-800
                    rounded-xl p-6 text-center text-gray-400">
            Driver ini belum memiliki pesanan.
        </div>
    @endif

</div>
@endsection