<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        // Buat wallet otomatis
        Wallet::create([
            'user_id' => $user->id,
            'saldo' => 0,
        ]);

        return response()->json([
            'message' => 'Register berhasil, wallet otomatis dibuat.',
            'data' => $user
        ], 201);
    }
}
