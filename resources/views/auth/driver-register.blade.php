@extends('layouts.main')

@section('content')
<div class="flex justify-center mt-20">
    <div class="bg-white shadow-lg rounded-lg p-10 w-96">

        <h2 class="text-2xl font-bold mb-4 text-center">Daftar Driver</h2>

        <form method="POST" action="/register/driver">
            @csrf

            <label>Nama</label>
            <input type="text" name="name" required
                   class="w-full px-3 py-2 border rounded mb-4">

            <label>Email</label>
            <input type="email" name="email" required
                   class="w-full px-3 py-2 border rounded mb-4">

            <label>No HP</label>
            <input type="text" name="phone" required
                   class="w-full px-3 py-2 border rounded mb-4">

            <label>Plat Motor</label>
            <input type="text" name="plate_number" required
                   class="w-full px-3 py-2 border rounded mb-4">

            <label>Password</label>
            <input type="password" name="password" required
                   class="w-full px-3 py-2 border rounded mb-4">

            <button class="w-full bg-green-600 text-white py-3 rounded hover:bg-green-700">
                Daftar
            </button>
        </form>

    </div>
</div>
@endsection
