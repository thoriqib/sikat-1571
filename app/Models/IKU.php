<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iku extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'satuan',
        'target',
        'tahun',
    ];

    protected $table = 'iku';

    public function pjs()
    {
        return $this->belongsToMany(User::class, 'iku_user');
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'iku_id');
    }


}

