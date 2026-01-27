<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IKU extends Model
{
    protected $fillable = [
        'nama',
        'satuan',
        'target',
        'tahun',
    ];

    protected $table = 'iku';

    const SATUAN = ['Persen', 'Poin'];

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'iku_id');
    }
}
