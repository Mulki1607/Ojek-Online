<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;

class DriverLoginController extends Controller
{
    public function showDriverLoginForm()
    {
        return view('auth.driver-login');
    }

    public function driverLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $driver = Driver::where('email', $request->email)->first();

        if (!$driver || !Hash::check($request->password, $driver->password)) {
            return back()->with('error', 'Email atau password salah.');
        }

        session(['driver_id' => $driver->id]);

        return redirect('/driver/dashboard');
    }
}
