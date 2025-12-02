<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Tampilkan semua admin.
     */
    public function index()
    {
        $admins = Admin::all();
        return response()->json($admins);
    }

    /**
     * Tambah admin baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::create([
            'nama'     => $validated['nama'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return response()->json([
            'message' => 'Admin berhasil ditambahkan',
            'admin'   => $admin
        ], 201);
    }

    /**
     * Tampilkan admin tertentu.
     */
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return response()->json($admin);
    }

    /**
     * Update admin.
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'nama'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|email|unique:admins,email,' . $id,
            'password' => 'sometimes|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $admin->update($validated);

        return response()->json([
            'message' => 'Admin berhasil diperbarui',
            'admin'   => $admin
        ]);
    }

    /**
     * Hapus admin.
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return response()->json(['message' => 'Admin berhasil dihapus']);
    }
}
