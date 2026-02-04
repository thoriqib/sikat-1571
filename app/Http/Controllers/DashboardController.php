<?php

namespace App\Http\Controllers;

use App\Models\Iku;
use App\Models\Laporan;
use App\Models\Tahapan;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tahun = now()->year;

        if ($user->role === 'admin') {
            return $this->adminDashboard($tahun);
        }

        return $this->pjDashboard($user, $tahun);
    }

    protected function adminDashboard($tahun)
    {
        $ikus = Iku::with(['laporan'])
            ->orderBy('kode')
            ->get();

        return view('dashboard.admin', compact('ikus', 'tahun'));
    }

    protected function pjDashboard($user, $tahun)
    {
        $ikus = Iku::with(['laporan'])
            ->where('user_id', $user->id)
            ->get();

        return view('dashboard.pj', compact('ikus', 'tahun'));
    }
}

