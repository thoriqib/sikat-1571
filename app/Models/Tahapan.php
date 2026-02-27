<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahapan extends Model
{
    protected $fillable = ['kegiatan_id','nama', 'urutan'];
    protected $table = 'tahapan';

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'tahapan_id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
