<?php

namespace App\Http\Controllers;

use App\Models\Iku;
use App\Models\Laporan;
use App\Models\Tahapan;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = 2026;

        // hitung total file laporan yang sudah diupload
        $totalFile = Laporan::where('tahun', $tahun)
            ->whereNotNull('link')
            ->count();

        $iku = Iku::withCount('kegiatan')->get();

        return view('dashboard', compact(
            'iku',
            'tahun',
            'totalFile'
        ));
    }

    public function kegiatan(Iku $iku)
    {
        $tahun = 2026;

        $kegiatan = $iku->kegiatan()
            ->withCount([
                'laporan as laporan_terisi' => function ($q) use ($tahun) {
                    $q->where('tahun', $tahun)
                    ->whereNotNull('link');
                }
            ])
            ->get();

        return view('kegiatan.index', compact('iku', 'kegiatan', 'tahun'));
    }

}