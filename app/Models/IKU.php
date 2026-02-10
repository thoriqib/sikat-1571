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

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'iku_id');
    }


}
