<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IKU;
use App\Models\Kegiatan;
use App\Models\Tahapan;
use Illuminate\Http\Request;

class AdminTahapanController extends Controller
{
    public function index(Kegiatan $kegiatan)
    {
        $tahapan = $kegiatan->tahapan()->orderBy('urutan')->get();
        return view('admin.tahapan.index', compact('kegiatan','tahapan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required',
            'nama' => 'required',
            'urutan' => 'required',
        ]);

        Tahapan::create($request->only('kegiatan_id','nama', 'urutan' ));

        return back()->with('success','Tahapan berhasil ditambahkan');
    }

    public function update(Request $request, Tahapan $tahapan)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $tahapan->update($request->only('nama'));

        return back()->with('success','Tahapan berhasil diupdate');
    }

    public function destroy(Tahapan $tahapan)
    {
        $tahapan->delete();
        return back()->with('success','Tahapan berhasil dihapus');
    }
}
