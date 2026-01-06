<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\LandingController;

/* AUTH */
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\DriverLoginController;
use App\Http\Controllers\Auth\DriverRegisterController;
use App\Http\Controllers\Auth\AdminLoginController;

/* USER */
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\WalletController;

/* DRIVER */
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DriverOrderController;
use App\Http\Controllers\KendaraanController;

/* ADMIN */
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminDriverController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');

/*
|--------------------------------------------------------------------------
| AUTH SELECTION (GUEST)
|--------------------------------------------------------------------------
*/
Route::view('/login', 'auth.select-login')->name('login.select');
Route::view('/register', 'auth.select-register')->name('register.select');

/*
|--------------------------------------------------------------------------
| USER AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login/user', [LoginController::class, 'showUserLoginForm'])->name('user.login');
Route::post('/login/user', [LoginController::class, 'userLogin'])->name('user.login.submit');

Route::get('/register/user', [RegisterController::class, 'showUserRegisterForm'])->name('user.register');
Route::post('/register/user', [RegisterController::class, 'userRegister'])->name('user.register.submit');

Route::post('/logout/user', [LoginController::class, 'logout'])->name('user.logout');

/*
|--------------------------------------------------------------------------
| DRIVER AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login/driver', [DriverLoginController::class, 'show'])->name('driver.login');
Route::post('/login/driver', [DriverLoginController::class, 'login'])->name('driver.login.submit');

Route::get('/register/driver', [DriverRegisterController::class, 'show'])->name('driver.register');
Route::post('/register/driver', [DriverRegisterController::class, 'store'])->name('driver.register.submit');

Route::post('/logout/driver', [DriverLoginController::class, 'logout'])->name('driver.logout');

/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('user')->group(function () {

    Route::view('/home', 'user.home')->name('user.home');

    /* ORDER */
    Route::view('/order/select', 'user.order-select')->name('user.order.select');
    Route::get('/order/form/{type}', [UserOrderController::class, 'orderForm'])->name('user.order.form');
    Route::post('/order/submit', [UserOrderController::class, 'submitOrder'])->name('user.order.submit');
    Route::post('/order/create', [UserOrderController::class, 'create'])->name('user.order.create');

    /* MAP */
    Route::view('/pickup/map', 'user.pickup-map')->name('user.pickup.map');
    Route::get('/nearby', [UserController::class, 'nearbyDrivers'])->name('user.nearby');
    Route::post('/find-drivers', [UserController::class, 'findDrivers'])->name('user.find.drivers');
    Route::get('/driver/{id}/map', [UserController::class, 'showDriverMap'])->name('user.driver.map');

    /* KENDARAAN DRIVER (VIEW USER) */
    Route::get('/driver/{id}/kendaraan', [KendaraanController::class, 'showForUser'])
        ->name('user.driver.kendaraan');

    /* RIWAYAT & RATING */
    Route::get('/orders', [UserOrderController::class, 'orderHistory'])->name('user.orders');
    Route::post('/orders/{id}/rate', [RatingController::class, 'store'])->name('user.order.rate');

    /* WALLET USER */
    Route::get('/wallet', [WalletController::class, 'userWallet'])->name('user.wallet');
    Route::post('/wallet/topup', [WalletController::class, 'topup'])->name('user.wallet.topup');
});

/*
|--------------------------------------------------------------------------
| DRIVER AREA
|--------------------------------------------------------------------------
*/
Route::middleware('auth:driver')->prefix('driver')->group(function () {

    Route::view('/dashboard', 'driver.dashboard')->name('driver.dashboard');

    /* STATUS & LOCATION */
    Route::post('/toggle-online', [DriverController::class, 'toggleOnline'])->name('driver.toggle.online');
    Route::post('/update-location', [DriverController::class, 'updateLocation'])->name('driver.update.location');

    /* ORDER */
    Route::get('/orders', [DriverOrderController::class, 'index'])->name('driver.orders');
    Route::post('/orders/{id}/accept', [DriverOrderController::class, 'accept'])->name('driver.orders.accept');
    Route::post('/orders/{id}/complete', [DriverOrderController::class, 'complete'])->name('driver.orders.complete');
    Route::get('/orders/{id}/pickup-map', [DriverOrderController::class, 'pickupMap'])->name('driver.pickup.map');

    /* KENDARAAN */
    Route::post('/kendaraan', [KendaraanController::class, 'storeOrUpdate'])
        ->name('driver.kendaraan.save');

    /* WALLET DRIVER */
    Route::get('/wallet', [WalletController::class, 'driverWallet'])->name('driver.wallet');
    Route::post('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('driver.wallet.withdraw');
});

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/
Route::middleware('auth:admin')->prefix('admin')->group(function () {

    Route::redirect('/', '/admin/dashboard');

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    /* USER */
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::post('/users/{id}/toggle', [AdminUserController::class, 'toggle'])->name('admin.users.toggle');

    /* DRIVER */
    Route::get('/drivers', [AdminDriverController::class, 'index'])->name('admin.drivers.index');
    Route::post('/drivers/{id}/toggle', [AdminDriverController::class, 'toggle'])->name('admin.drivers.toggle');
    Route::get('/drivers/{id}/orders', [AdminDriverController::class, 'orders'])->name('admin.drivers.orders');

    /* KENDARAAN */
    Route::get('/kendaraan', [KendaraanController::class, 'adminIndex'])
        ->name('admin.kendaraan.index');

    /* REPORT */
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');
});