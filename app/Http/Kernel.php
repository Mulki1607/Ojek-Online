<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;


class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware
     */
    protected $middleware = [
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \Illuminate\Foundation\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Middleware groups
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Route middleware (INI BAGIAN PALING PENTING)
     */
    protected $routeMiddleware = [

        // DEFAULT LARAVEL AUTH (WAJIB ADA)
        'auth' => \App\Http\Middleware\Authenticate::class,

        // OPTIONAL: guest middleware
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        // ADMIN CUSTOM
        'admin.auth' => \App\Http\Middleware\AdminAuth::class,

        // OPTIONAL (kalau nanti dipakai)
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}