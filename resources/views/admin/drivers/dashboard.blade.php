@extends('layouts.main')

@section('content')
<div class="p-10">
    <h1 class="text-3xl font-bold">Driver Dashboard</h1>

    <p class="mt-4">Selamat datang, {{ auth()->user()->name }}!</p>
</div>
@endsection
