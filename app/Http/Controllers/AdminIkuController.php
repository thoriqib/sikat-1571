<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IKU;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminIkuController extends Controller
{
    public function index()
    {
        $iku = IKU::orderBy('kode')->get();
        $daftarTahun = [2020,2021,2022,2023,2024,2025,2026,2027,2028,2029,2030];
        return view('admin.iku.index', compact('iku', 'daftarTahun'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'satuan' => 'required|in:persen,poin',
            'target' => 'required|numeric',
            'realisasi' => 'numeric',
            'tahun' => 'required|integer',
        ]);

        IKU::create($request->all());

        return redirect()->back()->with('success', 'IKU berhasil ditambahkan');
    }

    public function update(Request $request, Iku $iku)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'satuan' => 'required|in:persen,poin',
            'target' => 'required|numeric',
            'realisasi' => 'numeric',
            'tahun' => 'required|integer',
        ]);


        $iku->update($request->all());

        return back()->with('success','IKU berhasil diupdate');
    }

    public function destroy(Iku $iku)
    {
        $iku->delete();
        return back()->with('success','IKU berhasil dihapus');
    }

    public function clone(Request $request)
    {
        $request->validate([
            'tahun_asal'   => 'required|integer',
            'tahun_tujuan' => 'required|integer|different:tahun_asal',
            'iku_ids'      => 'required|array|min:1',
        ]);

        $duplikat = [];
        $ikus = Iku::with('kegiatan.tahapan')
            ->where('tahun', $request->tahun_asal)
            ->whereIn('id', $request->iku_ids)
            ->get();

        foreach ($ikus as $iku) {
            if (Iku::where('kode', $iku->kode)
                ->where('tahun', $request->tahun_tujuan)
                ->exists()
            ) {
                $duplikat[] = $iku->kode;
            }
        }

        if ($duplikat) {
            return back()->with('error',
                'IKU berikut sudah ada di tahun tujuan: ' . implode(', ', $duplikat)
            );
        }

        DB::transaction(function () use ($ikus, $request) {
            foreach ($ikus as $iku) {

                $ikuBaru = Iku::create([
                    'kode'   => $iku->kode,
                    'nama'   => $iku->nama,
                    'satuan' => $iku->satuan,
                    'target' => $iku->target,
                    'tahun'  => $request->tahun_tujuan,
                ]);

                foreach ($iku->kegiatan as $k) {
                    $kBaru = $ikuBaru->kegiatan()->create([
                        'nama'  => $k->nama,
                        'pj_id' => $request->reset_pj ? null : $k->pj_id,
                    ]);

                    foreach ($k->tahapan as $t) {
                        $kBaru->tahapan()->create([
                            'nama' => $t->nama,
                            'urutan' => $t->urutan,
                        ]);
                    }
                }
            }
        });

        return back()->with('success', 'IKU berhasil dicopy ke tahun ' . $request->tahun_tujuan);
    }
}
