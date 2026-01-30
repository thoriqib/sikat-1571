<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Iku;

class IkuSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode' => '[1] [111] [1111]',
                'nama' => 'Persentase Publikasi/Laporan Statistik Kependudukan Dan Ketenagakerjaan Yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[1] [113] [1131]',
                'nama' => 'Persentase Publikasi/Laporan Statistik Kesejahteraan Rakyat Yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[1] [115] [1151]',
                'nama' => 'Persentase Publikasi/Laporan Statistik Ketahanan Sosial Yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[1] [121] [1211]',
                'nama' => 'Persentase Publikasi/Laporan Statistik Tanaman Pangan, Hortikultura, Dan Perkebunan Yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[1] [122] [1221]',
                'nama' => 'Persentase Publikasi/Laporan Statistik Peternakan, Perikanan, Dan Kehutanan Yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[1] [123] [1231]',
                'nama' => 'Persentase Publikasi/Laporan Statistik Industri Yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[1] [131] [1311]',
                'nama' => 'Persentase Publikasi/Laporan Statistik Distribusi Yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[1] [133] [1331]',
                'nama' => 'Persentase Publikasi/Laporan Statistik Harga Yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[1] [135] [1351]',
                'nama' => 'Persentase Publikasi/Laporan Statistik Keuangan, Teknologi Informasi, Dan Pariwisata Yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[1] [141] [1411]',
                'nama' => 'Persentase Publikasi/Laporan Neraca Produksi Yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[1] [141] [1412]',
                'nama' => 'Persentase Publikasi/Laporan Neraca Pengeluaran Yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[1] [141] [1413]',
                'nama' => 'Persentase Publikasi/Laporan Analisis dan Pengembangan Statistik yang Berkualitas',
                'satuan' => 'Persen',
                'target' => 100,
            ],
            [
                'kode' => '[2] [214] [2141]',
                'nama' => 'Persentase Kumulatif Desa Yang Berpredikat Desa Cinta Statistik',
                'satuan' => 'Persen',
                'target' => 11.76,
            ],
            [
                'kode' => '[2] [251] [2511]',
                'nama' => 'Tingkat Penyelenggaraan Pembinaan Statistik Sektoral Sesuai Standar',
                'satuan' => 'Persen',
                'target' => 114.89,
            ],
            [
                'kode' => '[2] [271] [2711]',
                'nama' => 'Indeks Pelayanan Publik - Penilaian Mandiri',
                'satuan' => 'Poin',
                'target' => 4.55,
            ],
            [
                'kode' => '[3] [324] [3241]',
                'nama' => 'Nilai SAKIP oleh Inspektorat',
                'satuan' => 'Poin',
                'target' => 75,
            ],
            [
                'kode' => '[3] [324] [3242]',
                'nama' => 'Indeks Implementasi BerAKHLAK',
                'satuan' => 'Persen',
                'target' => 63.2,
            ],
        ];

        foreach ($data as $item) {
            Iku::create([
                'kode' => $item['kode'],
                'nama' => $item['nama'],
                'satuan' => $item['satuan'],
                'target' => $item['target'],
                'tahun' => 2026,
            ]);
        }
    }
}
