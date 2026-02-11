<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Iku;
use Illuminate\Http\Request;

class AdminIkuController extends Controller
{
    public function index()
    {
        $iku = Iku::orderBy('kode')->get();
        return view('admin.iku.index', compact('iku'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'kode' => 'required',
        'nama' => 'required',
        'satuan' => 'required|in:persen,poin',
        'target' => 'required|integer',
        'tahun' => 'required|integer',
    ]);

        Iku::create($request->all());

        return redirect()->back()->with('success', 'IKU berhasil ditambahkan');
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
