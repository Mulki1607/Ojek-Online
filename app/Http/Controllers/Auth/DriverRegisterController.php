<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;

class DriverRegisterController extends Controller
{
    /**
     * Tampilkan form register driver
     */
    public function show()
    {
        return view('auth.driver-register');
    }

    /**
     * Proses register driver + auto create wallet
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:drivers,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|min:6',
        ]);

        // 1. Create driver
        $driver = Driver::create([
            'name'        => $validated['name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            'password'    => Hash::make($validated['password']),
            'status'      => 'aktif',
            'online'      => 0,
            'work_status' => 'available',
        ]);

        // 2. Auto create wallet (DRIVER)
        Wallet::create([
            'owner_type' => Driver::class,
            'owner_id'   => $driver->id,
            'balance'    => 0,
            'currency'   => 'IDR',
        ]);

        return redirect()
            ->route('driver.login')
            ->with('success', 'Akun driver berhasil dibuat. Silakan login.');
    }
}