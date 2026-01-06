<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Driver;
use App\Models\Pesanan;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * =========================
     * USER CRUD (TETAP)
     * =========================
     */
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_hp'    => 'required|string|max:20',
        ]);

        $user = User::create([
            'nama'     => $validated['nama'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
            'no_hp'    => $validated['no_hp'],
            'status'   => 'aktif',
        ]);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        return response()->json(User::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->only(['nama', 'email', 'no_hp', 'status']);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        return response()->json($user);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['message' => 'User dihapus']);
    }

    /**
     * =========================
     * DRIVER TERDEKAT (FIX BUG)
     * =========================
     */

    public function nearbyDrivers()
    {
        $drivers = Driver::with('kendaraan') // 🔑 WAJIB agar data kendaraan ikut
            ->where('online', 1)
            ->where(function ($q) {
                $q->whereNull('work_status')
                ->orWhere('work_status', 'available');
            })
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->get();

        return view('user.nearby', compact('drivers'));
    }

    /**
     * =========================
     * MAP DRIVER
     * =========================
     */
    public function showDriverMap($id)
    {
        $driver = Driver::where('online', 1)
            ->where('work_status', 'available') // 🔒 DOUBLE SAFETY
            ->whereNotNull('lat')
            ->whereNotNull('lng')
            ->findOrFail($id);

        return view('user.driver-map', compact('driver'));
    }

    /**
     * =========================
     * GPS USER (HANYA SIMPAN LOKASI)
     * =========================
     */
    public function findDrivers(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        session([
            'user_location' => [
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]
        ]);

        return response()->json(['status' => 'ok']);
    }
}