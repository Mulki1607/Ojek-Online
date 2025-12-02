<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    // ============================================
    // TAMPILKAN SEMUA RATING
    // ============================================
    public function index()
    {
        return response()->json(Rating::all(), 200);
    }

    // ============================================
    // TAMBAH RATING
    // ============================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer',
            'user_id' => 'required|integer',
            'driver_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string'
        ]);

        $rating = Rating::create($validated);

        return response()->json([
            'message' => 'Rating berhasil ditambahkan',
            'data' => $rating
        ], 201);
    }

    // ============================================
    // DETAIL RATING
    // ============================================
    public function show($id)
    {
        $rating = Rating::findOrFail($id);

        return response()->json($rating, 200);
    }

    // ============================================
    // UPDATE RATING
    // ============================================
    public function update(Request $request, $id)
    {
        $rating = Rating::findOrFail($id);

        $validated = $request->validate([
            'rating' => 'integer|min:1|max:5',
            'komentar' => 'nullable|string'
        ]);

        $rating->update($validated);

        return response()->json([
            'message' => 'Rating berhasil diperbarui',
            'data' => $rating
        ], 200);
    }

    // ============================================
    // HAPUS RATING
    // ============================================
    public function destroy($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();

        return response()->json([
            'message' => 'Rating berhasil dihapus'
        ], 200);
    }
}
