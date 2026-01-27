<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tahapan;

class tahapaneeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Persiapan',
            'Pengumpulan Data',
            'Pengolahan dan Analisis',
            'Diseminasi dan Evaluasi',
        ];

        foreach ($data as $nama) {
            Tahapan::create([
                'nama' => $nama,
            ]);
        }
    }
}
