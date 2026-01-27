<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iku;
use App\Models\Tahapan;
use App\Models\Laporan;

class IkuController extends Controller
{
    public function show($id)
{
    $tahun = 2026;
    $triwulan = ['I','II','III','IV'];

    $iku = Iku::findOrFail($id);
    $tahapan = Tahapan::all();

    $laporan = Laporan::where('iku_id', $iku->id)
        ->where('tahun', $tahun)
        ->whereNotNull('file_path')
        ->get()
        ->keyBy(fn($l) => $l->tahapan_id.'-'.$l->triwulan);

    return view('iku.show', compact(
        'iku','tahapan','triwulan','laporan','tahun'
    ));
}

}