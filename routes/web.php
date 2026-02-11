<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AdminIkuController;
use App\Http\Controllers\AdminKegiatanController;
use App\Http\Controllers\AdminTahapanController;


/*
|--------------------------------------------------------------------------
| GUEST (BELUM LOGIN)
|--------------------------------------------------------------------------
*/

// =====================
// Dashboard
// =====================
// Route::get('/', [DashboardController::class, 'index'])
//     ->name('dashboard');

    Route::get('/', function () {
        return redirect()->route('login');
    });

// =====================
// IKU (Matrix Tahapan x Triwulan)
// =====================
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

Route::prefix('admin')->name('admin.')->group(function () {

    // IKU
    Route::resource('iku', AdminIkuController::class);

    // Kegiatan per IKU
    Route::get('iku/{iku}/kegiatan', [AdminKegiatanController::class, 'index'])
        ->name('kegiatan.index');
    Route::resource('kegiatan', AdminKegiatanController::class)
        ->except(['index']);

    // Tahapan per Kegiatan
    Route::get('kegiatan/{kegiatan}/tahapan', [AdminTahapanController::class, 'index'])
        ->name('tahapan.index');
    Route::resource('tahapan', AdminTahapanController::class)
        ->except(['index']);
});

Route::post('/set-tahun', function (\Illuminate\Http\Request $request) {
    session(['tahun_aktif' => $request->tahun]);
    return back();
})->name('set.tahun');



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
