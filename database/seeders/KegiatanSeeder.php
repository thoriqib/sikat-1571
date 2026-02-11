<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kegiatan;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Sakernas Februari', 'iku_id' => 1, 'pj_id' => 7],
            ['nama' => 'Sakernas Agustus', 'iku_id' => 1, 'pj_id' => 7],
            ['nama' => 'Sakernas November', 'iku_id' => 1, 'pj_id' => 7],
            ['nama' => 'Susenas Maret', 'iku_id' => 2, 'pj_id' => 6],
            ['nama' => 'Seruti Triwulan I', 'iku_id' => 2, 'pj_id' => 6],
            ['nama' => 'Seruti Triwulan II', 'iku_id' => 2, 'pj_id' => 6],
            ['nama' => 'Seruti Triwulan III', 'iku_id' => 2, 'pj_id' => 6],
            ['nama' => 'Seruti Triwulan IV', 'iku_id' => 2, 'pj_id' => 6],
            ['nama' => 'Susenas September', 'iku_id' => 2, 'pj_id' => 6],
            ['nama' => 'SNLIK', 'iku_id' => 2, 'pj_id' => 6],
            ['nama' => 'Potensi Desa', 'iku_id' => 3, 'pj_id'=> 7],
            ['nama' => 'Survei Statistik Polkam', 'iku_id' => 3, 'pj_id'=> 7],
            ['nama' => 'Desa Cantik', 'iku_id' => 3, 'pj_id'=> 5],
            ['nama' => 'KSA Padi dan Jagung', 'iku_id' => 4, 'pj_id' => 9],
            ['nama' => 'Ubinan', 'iku_id' => 4, 'pj_id' => 9],
            ['nama' => 'VP-VN.Horti', 'iku_id' => 4, 'pj_id' => 9],
            ['nama' => 'Survei Indeks Produksi Hortikultura (VIP.Horti)', 'iku_id' => 4, 'pj_id' => 9],
            ['nama' => 'LPTB (Laporan pemotongan Ternak Bulanan)', 'iku_id' => 5, 'pj_id' => 9],
            ['nama' => 'Survei Kesejahteraan Petani (SKP)', 'iku_id' => 5, 'pj_id' => 9],
            ['nama' => 'Survei Perusahaan Kehutanan', 'iku_id' => 5, 'pj_id' => 9],
            ['nama' => 'Survei VIMK Triwulanan', 'iku_id' => 6, 'pj_id' => 8],
            ['nama' => 'Survei VIMK Tahunan', 'iku_id' => 6, 'pj_id' => 8],
            ['nama' => 'Survei IBS Triwulanan', 'iku_id' => 6, 'pj_id' => 8],
            ['nama' => 'STPIM', 'iku_id' => 6, 'pj_id' => 8],
            ['nama' => 'Captive Power', 'iku_id' => 6, 'pj_id' => 8],
            ['nama' => 'Survei SKTH', 'iku_id' => 6, 'pj_id' => 8],
            ['nama' => 'Survei SKTR', 'iku_id' => 6, 'pj_id' => 8],
            ['nama' => 'Survei Jasa Penunjang Angkutan (Pergudangan dan Kurir)', 'iku_id' => 7, 'pj_id' => 15],
            ['nama' => 'Survei Perdagangan Barang Domestik', 'iku_id' => 7, 'pj_id' => 15],
            ['nama' => 'Survei Pola Distribusi', 'iku_id' => 7, 'pj_id' => 15],
            ['nama' => 'Survei Pola Usaha Non Pertanian', 'iku_id' => 7, 'pj_id' => 15],
            ['nama' => 'Survei Angkutan Penumpang dan Barang di Terminal', 'iku_id' => 7, 'pj_id' => 15],
            ['nama' => 'Sensus Ekonomi 2026', 'iku_id' => 7, 'pj_id' => 15],
            ['nama' => 'Survei Biaya Hidup', 'iku_id' => 8, 'pj_id' => 12],
            ['nama' => 'Survei Harga Produsen', 'iku_id' => 8, 'pj_id' => 12],
            ['nama' => 'Survei Harga Perdagangan Besar', 'iku_id' => 8, 'pj_id' => 12],
            ['nama' => 'Survei Harga Kemahalan Konstruksi', 'iku_id' => 8, 'pj_id' => 12],
            ['nama' => 'Survei Harga Konsumen', 'iku_id' => 8, 'pj_id' => 12],
            ['nama' => 'Survei Statistik Pariwisata', 'iku_id' => 9, 'pj_id' => 13],
            ['nama' => 'Survei Statistik Keuangan', 'iku_id' => 9, 'pj_id' => 13],
            ['nama' => 'Penyusunan PDRB Menurut Lapangan Usaha', 'iku_id' => 10, 'pj_id' => 14],
            ['nama' => 'Survei Khusus Neraca Produksi', 'iku_id' => 10, 'pj_id' => 14],
            ['nama' => 'SKTNP Barang', 'iku_id' => 10, 'pj_id' => 14],
            ['nama' => 'SKTNP Jasa', 'iku_id' => 10, 'pj_id' => 14],
            ['nama' => 'Penyusunan PDRB Menurut Pengeluaran', 'iku_id' => 11, 'pj_id' => 14],
            ['nama' => 'SKLNPT', 'iku_id' => 11, 'pj_id' => 14],
            ['nama' => 'SKSPPI', 'iku_id' => 11, 'pj_id' => 14],
            ['nama' => 'Snapper', 'iku_id' => 11, 'pj_id' => 14],
            ['nama' => 'Pengumpulan Data Sekunder', 'iku_id' => 11, 'pj_id' => 14],
            ['nama' => 'Penyusunan Publikasi Statistik Daerah', 'iku_id' => 12, 'pj_id' => 14],
            ['nama' => 'Indikator Kesejahteraan Rakyat', 'iku_id' => 12, 'pj_id' => 14],
            ['nama' => 'Penilaian PEKPPP', 'iku_id' => 15, 'pj_id' => 10],
        ];

        foreach ($data as $item) {
            Kegiatan::create([
                'nama' => $item['nama'],
                'iku_id' => $item['iku_id'],
                'pj_id' => $item['pj_id'],
            ]);
        }
    }
}
