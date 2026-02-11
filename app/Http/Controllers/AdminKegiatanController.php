<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Iku;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class AdminKegiatanController extends Controller
{
    public function index(Iku $iku)
    {
        $kegiatan = $iku->kegiatan()->orderBy('nama')->get();
        return view('admin.kegiatan.index', compact('iku','kegiatan'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:iku,kode',
            'nama' => 'required',
        ]);

        Iku::create($request->only('kode','nama'));

        return back()->with('success','IKU berhasil ditambahkan');
    }

    public function update(Request $request, Iku $iku)
    {
        $request->validate([
            'kode' => 'required|unique:iku,kode,' . $iku->id,
            'nama' => 'required',
        ]);

        $iku->update($request->only('kode','nama'));

        return back()->with('success','IKU berhasil diupdate');
    }

    public function destroy(Iku $iku)
    {
        $iku->delete();
        return back()->with('success','IKU berhasil dihapus');
    }
}
