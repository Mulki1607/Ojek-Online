<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    /* ===============================
     | DRIVER: CREATE / UPDATE KENDARAAN
     =============================== */
    public function storeOrUpdate(Request $request)
    {
        $driver = Auth::guard('driver')->user();

        $data = $request->validate([
            'Plat_Nomor' => 'required|string|max:255',
            'Tipe'       => 'required|in:Motor,Mobil',
            'Merk'       => 'required|string|max:255',
            'Warna'      => 'required|string|max:255',
        ]);

        $data['driver_id'] = $driver->id;

        Kendaraan::updateOrCreate(
            ['driver_id' => $driver->id],
            $data
        );

        return back()->with('success', 'Data kendaraan berhasil disimpan');
    }

    /* ===============================
     | ADMIN: LIHAT DATA KENDARAAN DRIVER
     =============================== */
    public function adminIndex()
    {
        $kendaraans = Kendaraan::with('driver')->latest()->get();
        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    /* ===============================
     | USER: LIHAT KENDARAAN DRIVER
     =============================== */
    public function showForUser($driver_id)
    {
        $kendaraan = Kendaraan::where('driver_id', $driver_id)->first();
        return view('user.driver-kendaraan', compact('kendaraan'));
    }
}