<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    public function index()
    {
        // Jika user login → ke user home
        if (Auth::check()) {
            return redirect()->route('user.home');
        }

        // Jika driver login → ke driver dashboard
        if (Auth::guard('driver')->check()) {
            return redirect()->route('driver.dashboard');
        }

        // Jika admin login → ke admin dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Guest
        return view('landing.index', [
            'title' => 'Aplikasi Ojol'
        ]);
    }
}