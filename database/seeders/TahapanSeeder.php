<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tahapan;

class TahapanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($i = 1; $i <= 51; $i++) {
            $data[] = ['nama' => 'Persiapan', 'kegiatan_id' => $i, 'urutan' => 1];
            $data[] = ['nama' => 'Pengumpulan Data', 'kegiatan_id' => $i, 'urutan' => 2];
            $data[] = ['nama' => 'Pengolahan dan Analisis', 'kegiatan_id' => $i, 'urutan' => 3];
            $data[] = ['nama' => 'Diseminasi dan Evaluasi', 'kegiatan_id' => $i, 'urutan' => 4];
        }


        foreach ($data as $item) {
            Tahapan::create([
                'nama' => $item['nama'],
                'kegiatan_id' => $item['kegiatan_id'],
                'urutan' => $item['urutan']
            ]);
        }
    }
}
