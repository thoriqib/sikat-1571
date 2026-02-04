<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Iku;

class IkuUserSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua PJ
        $pjs = User::where('role', 'pj')->pluck('id');

        if ($pjs->isEmpty()) {
            $this->command->warn('Tidak ada user PJ');
            return;
        }

        // Ambil semua IKU tahun 2026
        $ikus = Iku::where('tahun', 2026)->get();

        foreach ($ikus as $iku) {
            // contoh logika pembagian PJ
            // setiap IKU punya 1–2 PJ
            $assignedPj = $pjs->random(rand(1, min(2, $pjs->count())));

            $iku->pjs()->syncWithoutDetaching($assignedPj);
        }
    }
}
