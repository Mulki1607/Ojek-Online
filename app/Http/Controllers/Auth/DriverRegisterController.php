<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;

class DriverRegisterController extends Controller
{
    public function showDriverRegisterForm()
    {
        return view('auth.driver-register');
    }

    public function driverRegister(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:drivers,email',
            'phone'    => 'required|string|max:20',
            'password' => 'required|min:6'
        ]);

        Driver::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'plate_number' => $request->plate_number,
            'password'     => Hash::make($request->password),
            // default
            'status'   => 'aktif',
            'online'   => 0,
        ]);

        return redirect()->route('driver.login')
                         ->with('success', 'Akun driver berhasil dibuat.');
    }
}
