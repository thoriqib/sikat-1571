<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Kegiatan;
use App\Models\Tahapan;
use App\Models\Iku;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaporanController extends Controller
{

public function create(Request $request)
{
    $iku      = null;
    $kegiatan = null;
    $tahapan  = null;

    if ($request->filled('kegiatan_id')) {
        $kegiatan = Kegiatan::with('iku')->findOrFail($request->kegiatan_id);
        $iku = $kegiatan->iku;
    }

    if ($request->filled('tahapan_id')) {
        $tahapan = Tahapan::findOrFail($request->tahapan_id);
    }

    return view('laporan.create', [
        'iku'       => $iku,
        'kegiatan'  => $kegiatan,
        'tahapan'   => $tahapan,
        'triwulan'  => $request->triwulan,
        'tahun'     => $request->tahun ?? now()->year,
        'ikus'   => Iku::orderBy('kode')->get(),
        'kegiatanList' => Kegiatan::orderBy('nama')->get(),
        'tahapanList'  => Tahapan::orderBy('nama')->get(),
        'triwulanList' => ['I','II','III','IV'],
    ]);
}

public function store(Request $request)
{
    try {
    // =====================
    // VALIDASI
    // =====================
    $request->validate([
        'kegiatan_id' => 'required|exists:kegiatan,id',
        'tahapan_id'  => 'required|exists:tahapan,id',
        'triwulan'    => 'required',
        'tahun'       => 'required|integer|min:2020',
        'judul'       => 'required|string|max:255',
        'link'        => 'required|url'  
    ]);

    // =====================
    // CEK DUPLIKAT LAPORAN
    // =====================
    $exists = Laporan::where('kegiatan_id', $request->kegiatan_id)
        ->where('tahapan_id', $request->tahapan_id)
        ->where('triwulan', $request->triwulan)
        ->where('tahun', $request->tahun)
        ->exists();

    // =====================
    // SIMPAN KE DATABASE
    // =====================
    Laporan::create([
        'kegiatan_id' => $request->kegiatan_id,
        'tahapan_id'  => $request->tahapan_id,
        'triwulan'    => $request->triwulan,
        'tahun'       => $request->tahun,
        'judul'       => $request->judul,
        'link'  => $request->link,
        'uploaded_by'=> auth()->id(),
    ]);

    // =====================
    // REDIRECT
    // =====================
    return redirect()
        ->route('kegiatan.show', $request->kegiatan_id)
        ->with('success', 'Laporan berhasil diupload.');
    
    } catch (\Throwable $e) {
        return back()
            ->withInput()
            ->with('error', 'Gagal menyimpan laporan: ' . $e->getMessage());
    }
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

