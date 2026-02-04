<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IkuController;
use App\Http\Controllers\TahapanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| GUEST (BELUM LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

/*
|--------------------------------------------------------------------------
| AUTH (SUDAH LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD (AUTO REDIRECT SESUAI ROLE)
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA
    |--------------------------------------------------------------------------
    | - Kelola IKU
    | - Kelola Tahapan
    | - Kelola User
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {

        Route::resource('iku', IkuController::class);
        Route::resource('tahapan', TahapanController::class);
        Route::resource('users', UserController::class);

    });

    /*
    |--------------------------------------------------------------------------
    | PENANGGUNG JAWAB (PJ)
    |--------------------------------------------------------------------------
    | - Upload / edit / hapus laporan milik sendiri
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:pj')->group(function () {

        Route::resource('laporan', LaporanController::class)
            ->only([
                'index',
                'create',
                'store',
                'edit',
                'update',
                'destroy'
            ]);

    });
});
