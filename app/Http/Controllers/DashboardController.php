<?php

namespace App\Http\Controllers;


use App\Models\Iku;
use App\Models\Laporan;
use App\Models\Tahapan;
use App\Models\Kegiatan;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun = session('tahun_aktif', 2026);

        // total seluruh file laporan
        $totalFile = Laporan::where('tahun', $tahun)
            ->whereNotNull('link_laporan')
            ->count();

        $iku = Iku::query()
        ->when(!auth()->user()->isAdmin(), function ($query) use ($tahun) {
            $query->whereHas('kegiatan', function ($q) use ($tahun) {
                $q->where('pj_id', auth()->id())
                  ->where('tahun', $tahun);
            });
        })
        ->where('tahun', $tahun)
        ->get();

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

            $kegiatan = Kegiatan::where('iku_id', $iku->id)
    ->visible()
 // 🔐 filter berdasarkan role
                ->withTahapanDanLaporan($tahun) // 🔄 eager loading custom
                ->get()
                ->map(fn ($k) => $k->hitungProgress());

            $totalFile = Laporan::tahun($tahun)
                ->withFile()
                ->whereHas('kegiatan', fn ($q) => $q->where('iku_id', $iku->id))
                ->visibleKegiatan() // 🔐 hanya kegiatan yg boleh dilihat
                ->count();

            return view('kegiatan.index', compact(
                'iku',
                'kegiatan',
                'tahun',
                'totalFile'
            ));
        }

        public function scopeVisible($query)
        {
            if (!auth()->user()->isAdmin()) {
                return $query->where('pj_id', auth()->id());
            }

            return $query;
        }

        public function scopeWithTahapanDanLaporan($query, $tahun)
        {
            return $query->with([
                'tahapan',
                'laporan' => function ($q) use ($tahun) {
                    $q->where('tahun', $tahun)
                    ->whereNotNull('link_laporan');
                }
            ]);
        }


}