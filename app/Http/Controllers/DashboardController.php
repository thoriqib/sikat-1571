<?php

namespace App\Http\Controllers;

use App\Models\Iku;
use App\Models\Laporan;
use App\Models\Tahapan;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = session('tahun_aktif', 2026);

        // total seluruh file laporan
        $totalFile = Laporan::where('tahun', $tahun)
            ->whereNotNull('link_laporan')
            ->count();

        $iku = Iku::with([
            'kegiatan.tahapan',
            'kegiatan.laporan' => function ($q) use ($tahun) {
                $q->where('tahun', $tahun)
                  ->whereNotNull('link_laporan');
            }
        ])->get();

        $iku->each(function ($i) {
            $target = 0;
            $uploaded = 0;

            foreach ($i->kegiatan as $kegiatan) {
                $targetKegiatan = $kegiatan->tahapan->count() * 4;
                $uploadedKegiatan = $kegiatan->laporan->count();

                $target += $targetKegiatan;
                $uploaded += $uploadedKegiatan;
            }

            $i->target_laporan = $target;
            $i->uploaded_laporan = $uploaded;
            $i->persentase = $target > 0
                ? round(($uploaded / $target) * 100)
                : 0;
        });

        return view('dashboard', compact(
            'iku',
            'tahun',
            'totalFile'
        ));
    }

        public function kegiatan(Iku $iku)
    {
        $tahun = session('tahun_aktif', 2026);

        $kegiatan = $iku->kegiatan()
            ->with([
                'tahapan',
                'laporan' => function ($q) use ($tahun) {
                    $q->where('tahun', $tahun)
                      ->whereNotNull('link_laporan');
                }
            ])
            ->get();

        $kegiatan->each(function ($k) {
            $target = $k->tahapan->count() * 4;
            $uploaded = $k->laporan->count();

            $k->target_laporan = $target;
            $k->laporan_terisi = $uploaded;
            $k->persentase = $target > 0
                ? round(($uploaded / $target) * 100)
                : 0;
        });

        $totalFile = Laporan::where('tahun', $tahun)
            ->whereNotNull('link_laporan')
            ->whereHas('kegiatan', function ($q) use ($iku) {
                $q->where('iku_id', $iku->id);
            })
            ->count();

        return view('kegiatan.index', compact(
            'iku',
            'kegiatan',
            'tahun',
            'totalFile'
        ));
    }
}