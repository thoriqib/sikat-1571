<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'iku_id',
        'tahapan_id',
        'judul',
        'triwulan',
        'tahun',
        'isi',
        'path'
    ];

    public function iku()
    {
        return $this->belongsTo(Iku::class);
    }

    public function tahapan()
    {
        return $this->belongsTo(Tahapan::class);
    }
}
