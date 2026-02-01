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
    $request->validate([
        'judul' => 'required|string|max:255',
        'file' => 'required|mimes:pdf'
    ]);

    $path = $request->file('file')->store('laporan', 'public');

    Laporan::updateOrCreate(
        [
            'iku_id' => $request->iku_id,
            'tahapan_id' => $request->tahapan_id,
            'triwulan' => $request->triwulan,
            'tahun' => $request->tahun,
        ],
        [
            'judul' => $request->judul,
            'file_path' => $path
        ]
    );

    return redirect()
        ->route('iku.show', $request->iku_id)
        ->with('success', 'Laporan berhasil diupload');
}

public function edit(Laporan $laporan)
{
    return view('laporan.edit', compact('laporan'));
}


public function update(Request $request, Laporan $laporan)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'file'  => 'nullable|mimes:pdf|max:10240'
    ]);

    // Jika upload file baru
    if ($request->hasFile('file')) {

        // hapus file lama
        if ($laporan->file_path && Storage::disk('public')->exists($laporan->file_path)) {
            Storage::disk('public')->delete($laporan->file_path);
        }

        // simpan file baru
        $laporan->file_path = $request->file('file')
            ->store('laporan', 'public');
    }

    $laporan->update([
        'judul' => $request->judul
    ]);

    return redirect()
        ->route('iku.show', [$laporan->iku_id])
        ->with('success', 'Dokumen berhasil diperbarui');
}

public function destroy(Laporan $laporan)
{
    if ($laporan->file_path && Storage::disk('public')->exists($laporan->file_path)) {
        Storage::disk('public')->delete($laporan->file_path);
    }

    $laporan->delete();

    return back()->with('success', 'Dokumen berhasil dihapus');
}



}

