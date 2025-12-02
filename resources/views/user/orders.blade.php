@extends('layouts.main')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Riwayat Pesanan</h2>

    @forelse ($orders as $order)
        <div class="p-3 mb-2 border rounded">
            Driver ID: {{ $order->driver_id }}  
            <br>
            Status: {{ $order->status }}
        </div>
    @empty
        <p>Belum ada pesanan.</p>
    @endforelse
</div>
@endsection
