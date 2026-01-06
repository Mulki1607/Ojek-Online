@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">

    {{-- PAGE HEADER --}}
    <div class="mb-10">
        <h1 class="text-2xl font-semibold text-white">
            Dashboard Admin
        </h1>
        <p class="text-sm text-gray-400 mt-1">
            Ringkasan aktivitas sistem secara real-time
        </p>
    </div>

    {{-- KPI CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">

        {{-- USERS --}}
        <div class="bg-white/5 backdrop-blur
                    border border-white/10
                    rounded-xl p-6">
            <p class="text-sm text-gray-400">Total Users</p>
            <p class="text-3xl font-bold text-white mt-1">
                {{ $totalUsers }}
            </p>
            <p class="text-xs text-green-400 mt-2">
                Aktif: {{ $activeUsers }}
            </p>
        </div>

        {{-- DRIVERS --}}
        <div class="bg-white/5 backdrop-blur
                    border border-white/10
                    rounded-xl p-6">
            <p class="text-sm text-gray-400">Total Drivers</p>
            <p class="text-3xl font-bold text-white mt-1">
                {{ $totalDrivers }}
            </p>
            <p class="text-xs text-blue-400 mt-2">
                Online: {{ $onlineDrivers }}
            </p>
        </div>

        {{-- ORDERS --}}
        <div class="bg-white/5 backdrop-blur
                    border border-white/10
                    rounded-xl p-6">
            <p class="text-sm text-gray-400">Total Orders</p>
            <p class="text-3xl font-bold text-white mt-1">
                {{ $totalOrders }}
            </p>
            <p class="text-xs text-green-400 mt-2">
                Completed: {{ $completedOrders }}
            </p>
        </div>

    </div>

    {{-- CHART SECTION --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">

        {{-- ORDER STATUS --}}
        <div class="bg-white/5 backdrop-blur
                    border border-white/10
                    rounded-xl p-6">
            <h3 class="font-medium text-gray-200 mb-4">
                Status Pesanan
            </h3>
            <div class="flex justify-center">
                <canvas id="orderChart" class="max-w-[260px] max-h-[260px]"></canvas>
            </div>
        </div>

        {{-- DRIVER STATUS --}}
        <div class="bg-white/5 backdrop-blur
                    border border-white/10
                    rounded-xl p-6">
            <h3 class="font-medium text-gray-200 mb-4">
                Status Driver
            </h3>
            <div class="flex justify-center">
                <canvas id="driverChart" class="max-w-[260px] max-h-[260px]"></canvas>
            </div>
        </div>

    </div>

    {{-- RECENT ACTIVITY --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        {{-- RECENT ORDERS --}}
        <div class="bg-white/5 backdrop-blur
                    border border-white/10
                    rounded-xl p-5">
            <h3 class="font-medium text-gray-200 mb-4">
                Pesanan Terbaru
            </h3>

            @forelse($recentOrders as $order)
                <div class="border-b border-white/10 py-2 text-sm">
                    <div class="text-white font-medium">
                        Order #{{ $order->id }}
                    </div>
                    <div class="text-xs text-gray-400">
                        Status: {{ strtoupper($order->status) }}
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">
                    Belum ada pesanan
                </p>
            @endforelse
        </div>

        {{-- RECENT USERS --}}
        <div class="bg-white/5 backdrop-blur
                    border border-white/10
                    rounded-xl p-5">
            <h3 class="font-medium text-gray-200 mb-4">
                User Terbaru
            </h3>

            @forelse($recentUsers as $user)
                <div class="border-b border-white/10 py-2 text-sm">
                    <div class="text-white font-medium">
                        {{ $user->name }}
                    </div>
                    <div class="text-xs text-gray-400">
                        {{ $user->created_at->diffForHumans() }}
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">
                    Belum ada user
                </p>
            @endforelse
        </div>

        {{-- RECENT DRIVERS --}}
        <div class="bg-white/5 backdrop-blur
                    border border-white/10
                    rounded-xl p-5">
            <h3 class="font-medium text-gray-200 mb-4">
                Driver Terbaru
            </h3>

            @forelse($recentDrivers as $driver)
                <div class="border-b border-white/10 py-2 text-sm">
                    <div class="text-white font-medium">
                        {{ $driver->name }}
                    </div>
                    <div class="text-xs text-gray-400">
                        {{ $driver->created_at->diffForHumans() }}
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">
                    Belum ada driver
                </p>
            @endforelse
        </div>

    </div>

</div>

{{-- CHART JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    Chart.defaults.color = '#cbd5f5';

    new Chart(document.getElementById('orderChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Accepted', 'Completed'],
            datasets: [{
                data: [
                    {{ $orderPending }},
                    {{ $orderAccepted }},
                    {{ $orderCompleted }}
                ],
                backgroundColor: ['#f59e0b', '#3b82f6', '#22c55e'],
                borderWidth: 0
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    new Chart(document.getElementById('driverChart'), {
        type: 'pie',
        data: {
            labels: ['Online', 'Offline'],
            datasets: [{
                data: [
                    {{ $onlineDrivers }},
                    {{ $offlineDrivers }}
                ],
                backgroundColor: ['#22c55e', '#ef4444'],
                borderWidth: 0
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection