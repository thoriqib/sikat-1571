<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iku;
use App\Models\Tahapan;
use App\Models\Laporan;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
       public function show(Kegiatan $kegiatan)
    {
        $tahun = 2026;
        $tahapan = Tahapan::where('kegiatan_id', $kegiatan->id)->orderBy('urutan')->get();
        $triwulan = [1,2,3,4];

        $laporan = Laporan::where('kegiatan_id', $kegiatan->id)
            ->where('tahun', $tahun)
            ->get()
            ->keyBy(fn ($l) => $l->tahapan_id.'-'.$l->triwulan);

        return view('laporan.matriks', compact(
            'kegiatan', 'tahapan', 'triwulan', 'laporan', 'tahun'
        ));
    }
}