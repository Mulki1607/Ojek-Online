<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Tampilkan form register user
     */
    public function showUserRegisterForm()
    {
        return view('auth.user-register');
    }

    /**
     * Proses register user + auto create wallet
     */
    public function userRegister(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|min:6',
        ]);

        // 1. Create user
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'phone'    => $validated['phone'],
            'password' => Hash::make($validated['password']),
        ]);

        // 2. Auto create wallet (USER)
        Wallet::create([
            'owner_type' => User::class,
            'owner_id'   => $user->id,
            'balance'    => 0,
            'currency'   => 'IDR',
        ]);

        return redirect()
            ->route('user.login')
            ->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}