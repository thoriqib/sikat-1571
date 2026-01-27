<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IkuController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =====================
// Dashboard
// =====================
Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');


// =====================
// IKU (Matrix Tahapan x Triwulan)
// =====================
Route::get('/iku/{id}', [IkuController::class, 'show'])
    ->name('iku.show');


// =====================
// Laporan (Upload)
// =====================
Route::get('/laporan/create', [LaporanController::class, 'create'])
    ->name('laporan.create');

Route::post('/laporan/store', [LaporanController::class, 'store'])
    ->name('laporan.store');

