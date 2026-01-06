<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, $pesananId)
    {
        $user = Auth::user();

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $order = Pesanan::where('id', $pesananId)
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->firstOrFail();

        // Cegah double rating
        if ($order->rating) {
            return back()->with('error', 'Pesanan ini sudah diberi rating.');
        }

        Rating::create([
            'pesanan_id' => $order->id,
            'user_id'    => $user->id,
            'driver_id'  => $order->driver_id,
            'rating'     => $request->rating,
            'komentar'    => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih atas penilaian Anda.');
    }
}