<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Iku;
use App\Models\Tahapan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function create(Request $request)
{
    return view('laporan.create', [
        'iku_id' => $request->iku_id,
        'tahapan_id' => $request->tahapan_id,
        'triwulan' => $request->triwulan,
        'tahun' => $request->tahun
    ]);
}

public function store(Request $request)
{
    $path = $request->file('file')
        ->store('laporan','public');

    Laporan::updateOrCreate(
        [
            'iku_id' => $request->iku_id,
            'tahapan_id' => $request->tahapan_id,
            'triwulan' => $request->triwulan,
            'tahun' => $request->tahun
        ],
        ['file_path' => $path]
    );

    return redirect()->route('iku.show', $request->iku_id)
        ->with('success','Laporan berhasil diupload');
}

}

