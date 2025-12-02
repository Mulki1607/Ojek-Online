<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Driver;
use App\Models\Pesanan;

class UserController extends Controller
{
    /**
     * Tampilkan semua user
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Tambah user baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_hp'    => 'required|string|max:20',
            'status'   => 'nullable|string',
        ]);

        $user = User::create([
            'nama'     => $validated['nama'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
            'no_hp'    => $validated['no_hp'],
            'status'   => $validated['status'] ?? 'aktif',
        ]);

        return response()->json([
            'message' => 'User berhasil ditambahkan',
            'user'    => $user
        ], 201);
    }

    /**
     * Tampilkan user berdasarkan ID
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nama'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|min:6',
            'no_hp'    => 'sometimes|string|max:20',
            'status'   => 'sometimes|string',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'User berhasil diupdate',
            'user'    => $user
        ]);
    }

    /**
     * Hapus user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }

    /**
     * Fitur: Driver terdekat (online)
     */
    public function nearbyDrivers()
{
    // Ambil driver online
    $drivers = \App\Models\Driver::where('online', 1)->get();

    return view('user.nearby', [
        'drivers' => $drivers
    ]);
}


    /**
     * Fitur: Riwayat Pesanan User
     */
    public function orderHistory()
    {
        $orders = Pesanan::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('user.orders', compact('orders'));
    }
    
}
