<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =====================
// Dashboard
// =====================
// Route::get('/', [DashboardController::class, 'index'])
//     ->name('dashboard');


// =====================
// IKU (Matrix Tahapan x Triwulan)
// =====================
Route::get('/iku/{id}', [IkuController::class, 'show'])
    ->name('iku.show');

//Route::middleware(['auth'])->group(function () {

    // 1️⃣ Dashboard IKU
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // 2️⃣ Dashboard Kegiatan per IKU
    Route::get('/iku/{iku}/kegiatan', [DashboardController::class, 'kegiatan'])
        ->name('kegiatan.index');

    // 3️⃣ Matriks Laporan per Kegiatan
    Route::get('/kegiatan/{kegiatan}/laporan', [KegiatanController::class, 'show'])
        ->name('kegiatan.show');

//});

Route::get('/api/iku/{iku}/kegiatan', function ($ikuId) {
    return \App\Models\Kegiatan::where('iku_id', $ikuId)
        ->select('id', 'nama')
        ->orderBy('nama')
        ->get();
});

Route::get('/api/kegiatan/{kegiatan}/tahapan', function ($kegiatanId) {
    return \App\Models\Tahapan::where('kegiatan_id', $kegiatanId)
        ->select('id', 'nama')
        ->orderBy('urutan')
        ->get();
});



// =====================
// Laporan (Upload)
// =====================

    
Route::get('/laporan/create', [LaporanController::class, 'create'])
    ->name('laporan.create');
Route::post('/laporan/store', [LaporanController::class, 'store'])
    ->name('laporan.store');
// Edit & Update
Route::get('/laporan/{laporan}/edit', [LaporanController::class, 'edit'])
    ->name('laporan.edit');

Route::put('/laporan/{laporan}', [LaporanController::class, 'update'])
    ->name('laporan.update');

// Delete
Route::delete('/laporan/{laporan}', [LaporanController::class, 'destroy'])
    ->name('laporan.destroy');


