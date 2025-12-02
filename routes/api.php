<?php

use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\AdminDashboardController;

// Auth
use App\Http\Controllers\AuthController;

// Master Data
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\KendaraanController;

// Pesanan & Pembayaran
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PembayaranController;

// Wallet & Finance
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\WalletTransactionController;

// Rating & Settings
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SettingController;


/*
|--------------------------------------------------------------------------
| ADMIN API
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);
});


/*
|--------------------------------------------------------------------------
| DRIVER
|--------------------------------------------------------------------------
*/
Route::get('/drivers', [DriverController::class, 'index']);
Route::post('/drivers', [DriverController::class, 'store']);
Route::get('/drivers/{id}', [DriverController::class, 'show']);
Route::put('/drivers/{id}', [DriverController::class, 'update']);
Route::delete('/drivers/{id}', [DriverController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| USER, ADMIN, KENDARAAN
|--------------------------------------------------------------------------
*/
Route::apiResource('admins', AdminController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('kendaraans', KendaraanController::class);


/*
|--------------------------------------------------------------------------
| PESANAN & PEMBAYARAN
|--------------------------------------------------------------------------
*/
Route::apiResource('pesanans', PesananController::class);
Route::apiResource('pembayarans', PembayaranController::class);


/*
|--------------------------------------------------------------------------
| WALLET, TOPUP, WITHDRAW
|--------------------------------------------------------------------------
*/
Route::apiResource('wallets', WalletController::class);
Route::apiResource('topups', TopUpController::class);
Route::apiResource('withdraws', WithdrawController::class);

Route::get('/wallet-transactions', [WalletTransactionController::class, 'index']);
Route::get('/wallet-transactions/{id}', [WalletTransactionController::class, 'show']);
Route::get('/wallet-transactions/user/{userId}', [WalletTransactionController::class, 'userTransactions']);


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| RATING
|--------------------------------------------------------------------------
*/
Route::apiResource('ratings', RatingController::class);


/*
|--------------------------------------------------------------------------
| SETTINGS
|--------------------------------------------------------------------------
*/
Route::get('/setting', [SettingController::class, 'index']);
Route::post('/setting/update', [SettingController::class, 'update']);


/*
|--------------------------------------------------------------------------
| HEALTH CHECK
|--------------------------------------------------------------------------
*/
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
