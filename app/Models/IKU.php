<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iku extends Model
{
    protected $table = 'iku';

    protected $fillable = [
        'kode', 'nama', 'satuan', 'target', 'tahun'
    ];


    public function pjs()
    {
        return $this->belongsToMany(User::class, 'iku_user');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}

