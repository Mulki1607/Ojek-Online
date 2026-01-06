<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    /**
     * Tampilkan semua user
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Toggle aktif / nonaktif user
     */
    public function toggle($id)
{
    $user = User::findOrFail($id);

    if ($user->status === 'aktif') {
        $user->status = 'nonaktif';
    } else {
        $user->status = 'aktif';
    }

    $user->save();

    return back()->with('success', 'Status user berhasil diubah.');
}
}