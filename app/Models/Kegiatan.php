<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    public function iku()
    {
        return $this->belongsTo(IKU::class);
    }

    public function tahapan()
    {
        return $this->hasMany(Tahapan::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}
