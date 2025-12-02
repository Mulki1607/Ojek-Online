@extends('layouts.main')

@section('content')
<div class="flex justify-center mt-20">
    <div class="bg-white shadow-lg rounded-lg p-10 w-96">

        <h2 class="text-2xl font-bold mb-4 text-center">Login User</h2>

        <form method="POST" action="/login/user">
            @csrf

            <label>Email</label>
            <input type="email" name="email" required
                   class="w-full px-3 py-2 border rounded mb-4">

            <label>Password</label>
            <input type="password" name="password" required
                   class="w-full px-3 py-2 border rounded mb-4">

            <button class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                Login
            </button>
        </form>

    </div>
</div>
@endsection
