<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'kegiatan_id',
        'tahapan_id',
        'judul',
        'triwulan',
        'tahun',
        'link_laporan',
        'isi',
        'uploaded_by'
    ];

    protected $table = 'laporan';

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }


    public function tahapan()
    {
        return $this->belongsTo(Tahapan::class, 'tahapan_id');
    }

    public function scopeTahun($query, $tahun)
{
    return $query->where('tahun', $tahun);
}

public function scopeWithFile($query)
{
    return $query->whereNotNull('link_laporan');
}

public function scopeVisibleKegiatan($query)
{
    if (!auth()->user()->isAdmin()) {
        return $query->whereHas('kegiatan', function ($q) {
            $q->where('pj_id', auth()->id());
        });
    }

    return $query;
}


    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Helper untuk URL file
    public function getFileUrlAttribute()
    {
        return $this->file_path
            ? asset('storage/' . $this->file_path)
            : null;
    }
}
