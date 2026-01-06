<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Form login user
     */
    public function showUserLoginForm()
    {
        return view('auth.user-login');
    }

    /**
     * Proses login user
     */
    public function userLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // PAKAI GUARD WEB SECARA EKSPLISIT
        if (Auth::guard('web')->attempt($credentials)) {
            
            // WAJIB: regenerate session
            $request->session()->regenerate();

            // redirect ke home user
            return redirect()->route('user.home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}