<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    // GET /drivers
    public function index()
    {
        return Driver::all();
    }

    // POST /drivers
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email|unique:drivers,email',
            'nomor_hp' => 'required|string',
        ]);

        $driver = Driver::create($validated);

        return response()->json([
            'message' => 'Driver created successfully',
            'data' => $driver
        ], 201);
    }

    // GET /drivers/{id}
    public function show($id)
    {
        $driver = Driver::findOrFail($id);
        return $driver;
    }

    // PUT /drivers/{id}
    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'sometimes|string',
            'email' => 'sometimes|email|unique:drivers,email,' . $id,
            'nomor_hp' => 'sometimes|string',
        ]);

        $driver->update($validated);

        return response()->json([
            'message' => 'Driver updated successfully',
            'data' => $driver
        ]);
    }

    // DELETE /drivers/{id}
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return response()->json([
            'message' => 'Driver deleted successfully'
        ]);
    }
    public function adminIndex()
{
    $drivers = Driver::all();
    return view('admin.drivers.index', compact('drivers'));
}

public function adminShow($id)
{
    $driver = Driver::findOrFail($id);
    return view('admin.drivers.show', compact('driver'));
}

public function toggleStatus($id)
{
    $driver = Driver::findOrFail($id);
    $driver->status = $driver->status === 'active' ? 'suspended' : 'active';
    $driver->save();

    return back();
}

public function toggleOnline(Request $request)
{
    $driver = Auth::guard('driver')->user();

    $driver->online = !$driver->online;

    if ($driver->online) {
        $driver->work_status = 'available';
    } else {
        $driver->work_status = 'offline';
    }

    /** @var \App\Models\Driver $driver */
    $driver->save();

    return back()->with(
        'success',
        $driver->online ? 'Status: Online' : 'Status: Offline'
    );
}

public function updateLocation(Request $request)
{
    $request->validate([
        'lat' => 'required|numeric',
        'lng' => 'required|numeric',
    ]);

    $driver = Auth::guard('driver')->user();

    /** @var \App\Models\Driver $driver */
    $driver->update([
        'lat' => $request->lat,
        'lng' => $request->lng,
    ]);

    return response()->json([
        'status' => 'success',
        'lat' => $driver->lat,
        'lng' => $driver->lng,
    ]);
}

}
