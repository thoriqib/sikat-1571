<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IKU;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminKegiatanController extends Controller
{
    public function index(Iku $iku)
    {
        $kegiatan = $iku->kegiatan()->with('pj')->orderBy('nama')->get();
        $users = User::orderBy('name')->get();

        return view('admin.kegiatan.index', compact('iku', 'kegiatan', 'users'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'iku_id' => 'required|exists:iku,id',
            'nama'   => 'required|string',
            'pj_id'  => 'nullable|exists:users,id',
        ]);

        Kegiatan::create([
            'iku_id' => $request->iku_id,
            'nama'   => $request->nama,
            'pj_id'  => $request->pj_id,
        ]);

        return back()->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'nama'  => 'required|string',
            'pj_id' => 'nullable|exists:users,id',
        ]);

        $kegiatan->update([
            'nama'  => $request->nama,
            'pj_id' => $request->pj_id,
        ]);

        return back()->with('success', 'Kegiatan berhasil diupdate.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return back()->with('success', 'Kegiatan berhasil dihapus.');
    }
}
