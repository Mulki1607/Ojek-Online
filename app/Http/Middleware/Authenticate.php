<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Redirect user yang belum login.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // Arahkan ke halaman pilih login (BUKAN route 'login' default Laravel)
            return route('login.select');
        }

        return null;
    }
}