<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // Tampilkan semua setting
    public function index()
    {
        $settings = Setting::all();
        return response()->json($settings);
    }

    // Update atau membuat setting baru
    public function update(Request $request)
    {
        $request->validate([
            'key'   => 'required|string',
            'value' => 'nullable|string'
        ]);

        $setting = Setting::updateOrCreate(
            ['key' => $request->key],
            ['value' => $request->value]
        );

        return response()->json([
            'message' => 'Setting updated successfully',
            'data' => $setting
        ]);
    }
}
