<?php

use Illuminate\Support\Facades\Route;

// ======================================================
// LANDING PAGE
// ======================================================
Route::get('/', function () {
    return view('landing.index', ['title' => 'Aplikasi Ojol']);
})->name('home');


// ======================================================
// USER AUTH
// ======================================================
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/login/user', [LoginController::class, 'showUserLoginForm'])->name('user.login');
Route::post('/login/user', [LoginController::class, 'userLogin'])->name('user.login.submit');

Route::get('/register/user', [RegisterController::class, 'showUserRegisterForm'])->name('user.register');
Route::post('/register/user', [RegisterController::class, 'userRegister'])->name('user.register.submit');


// ======================================================
// DRIVER AUTH
// ======================================================
use App\Http\Controllers\Auth\DriverLoginController;
use App\Http\Controllers\Auth\DriverRegisterController;

Route::get('/login/driver', [DriverLoginController::class, 'showDriverLoginForm'])->name('driver.login');
Route::post('/login/driver', [DriverLoginController::class, 'driverLogin'])->name('driver.login.submit');

Route::get('/register/driver', [DriverRegisterController::class, 'showDriverRegisterForm'])->name('driver.register');
Route::post('/register/driver', [DriverRegisterController::class, 'driverRegister'])->name('driver.register.submit');


// ======================================================
// ADMIN AUTH
// ======================================================
use App\Http\Controllers\Auth\AdminLoginController;

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


// ======================================================
// ADMIN PANEL (HARUS LOGIN ADMIN)
// ======================================================
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;

Route::prefix('admin')->group(function () { //pasang middleware auth admin jika sudah siap

    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // DRIVER MANAGEMENT
    Route::get('/drivers', [DriverController::class, 'adminIndex'])
        ->name('admin.drivers.index');

    Route::get('/drivers/{id}', [DriverController::class, 'adminShow'])
        ->name('admin.drivers.show');

    Route::post('/drivers/{id}/toggle', [DriverController::class, 'toggleStatus'])
        ->name('admin.drivers.toggle');

    Route::delete('/drivers/{id}', [DriverController::class, 'destroy'])
        ->name('admin.drivers.delete');

    // USER MANAGEMENT
    Route::get('/users', [UserController::class, 'adminIndex'])
        ->name('admin.users.index');

    Route::get('/users/{id}', [UserController::class, 'adminShow'])
        ->name('admin.users.show');

    // REPORTS
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('admin.reports');

    Route::post('/order/submit', [\App\Http\Controllers\UserOrderController::class, 'submitOrder'])
     ->name('user.order.submit');

     Route::post('/order/choose-driver', [\App\Http\Controllers\UserOrderController::class, 'chooseDriver'])
     ->name('user.order.chooseDriver');

});


// ======================================================
// FALLBACK ROUTE (404)
// ======================================================
// Redirect /admin ke /admin/dashboard
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
// =======================
// SELECT REGISTER TYPE
// =======================
Route::get('/register', function () {
    return view('auth.select-register');
})->name('register.select');

// =======================
// SELECT LOGIN TYPE
// =======================
Route::get('/login', function () {
    return view('auth.select-login');
})->name('login.select');
/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('user')->group(function () {

    // Halaman order select
    Route::get('/order/select', function () {
        return view('user.order-select');
    })->name('user.order.select');

    // Form isi titik jemput dan tujuan
    Route::get('/order/form/{type}', [\App\Http\Controllers\UserOrderController::class, 'orderForm'])
        ->name('user.order.form');
    Route::get('/home', function () {
        return view('user.home');
    })->name('user.home');

    Route::get('/order/select', function () {
        return view('user.order-select');
    })->name('user.order.select');

    Route::get('/nearby', [\App\Http\Controllers\UserController::class, 'nearbyDrivers'])
         ->name('user.nearby');

    Route::get('/orders', [\App\Http\Controllers\UserController::class, 'orderHistory'])
         ->name('user.orders');
});
use App\Http\Controllers\UserOrderController;

Route::middleware('auth')->prefix('user')->group(function () {

    Route::get('/nearby', [\App\Http\Controllers\UserController::class, 'nearbyDrivers'])
        ->name('user.nearby');

    Route::post('/order/submit', [UserOrderController::class, 'makeOrder'])
        ->name('user.order.submit');
});


