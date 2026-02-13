<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';  
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
    public function pj()
    {
        return $this->belongsTo(User::class, 'pj_id');
    }

    public function hitungProgress()
{
    $target = $this->tahapan->count() * 4;
    $uploaded = $this->laporan->count();

    $this->target_laporan = $target;
    $this->laporan_terisi = $uploaded;
    $this->persentase = $target > 0
        ? round(($uploaded / $target) * 100)
        : 0;

    return $this;
}

public function scopeVisible($query)
{
    if (auth()->check() && !auth()->user()->isAdmin()) {
        return $query->where('pj_id', auth()->id());
    }

    return $query;
}

public function scopeWithTahapanDanLaporan($query, $tahun)
{
    return $query->with([
        'tahapan',
        'laporan' => function ($q) use ($tahun) {
            $q->where('tahun', $tahun)
              ->whereNotNull('link_laporan');
        }
    ]);
}


}
