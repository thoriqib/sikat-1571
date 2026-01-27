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
        $totalTahapan = Tahapan::count();
        $totalTriwulan = 4;
        $totalWajib = $totalTahapan * $totalTriwulan; // 16

        $iku = Iku::with(['laporan' => function ($q) use ($tahun) {
            $q->where('tahun', $tahun)
              ->whereNotNull('file_path');
        }])->get();

        $iku->map(function ($iku) use ($totalWajib) {
            $iku->terisi = $iku->laporan->count();
            $iku->persentase = round(($iku->terisi / $totalWajib) * 100, 1);
            return $iku;
        });

        $totalFile = Laporan::whereNotNull('file_path')->count();

        return view('dashboard', compact('iku','totalFile','tahun'));
    }
}
