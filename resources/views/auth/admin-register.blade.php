@extends('layouts.adminreglog')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white shadow rounded p-6">

        <h2 class="text-2xl font-bold text-center mb-6">
            Register Admin
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.register.submit') }}">
            @csrf

            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="name" required
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" required
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" required
                       class="w-full border px-3 py-2 rounded">
            </div>

            <div class="mb-6">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                       class="w-full border px-3 py-2 rounded">
            </div>

            <button class="w-full bg-black text-white py-2 rounded">
                Daftar Admin
            </button>
        </form>

    </div>
</div>
@endsection