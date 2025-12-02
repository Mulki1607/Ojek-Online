<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Tampilkan semua kendaraan.
     */
    public function index()
    {
        $kendaraan = Kendaraan::all();
        return response()->json($kendaraan);
    }

    /**
     * Tambah kendaraan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'driver_id'     => 'required|exists:drivers,id',
            'jenis'         => 'required|string|max:50',     // motor / mobil
            'merek'         => 'required|string|max:100',
            'plat_nomor'    => 'required|string|max:20|unique:kendaraans,plat_nomor',
            'warna'         => 'required|string|max:50',
            'tahun'         => 'nullable|integer',
        ]);

        $kendaraan = Kendaraan::create($validated);

        return response()->json([
            'message'   => 'Kendaraan berhasil ditambahkan',
            'kendaraan' => $kendaraan
        ], 201);
    }

    /**
     * Tampilkan kendaraan berdasarkan ID.
     */
    public function show($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return response()->json($kendaraan);
    }

    /**
     * Update kendaraan.
     */
    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $validated = $request->validate([
            'driver_id'     => 'sometimes|exists:drivers,id',
            'jenis'         => 'sometimes|string|max:50',
            'merek'         => 'sometimes|string|max:100',
            'plat_nomor'    => 'sometimes|string|max:20|unique:kendaraans,plat_nomor,' . $id,
            'warna'         => 'sometimes|string|max:50',
            'tahun'         => 'sometimes|integer',
        ]);

        $kendaraan->update($validated);

        return response()->json([
            'message'   => 'Kendaraan berhasil diperbarui',
            'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Hapus kendaraan.
     */
    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return response()->json(['message' => 'Kendaraan berhasil dihapus']);
    }
}
