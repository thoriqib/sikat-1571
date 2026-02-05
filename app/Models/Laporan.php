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
        'file_path',
        'file_original_name',
        'file_size',
        'file_mime',
        'isi',
        'uploaded_by'
    ];

    protected $table = 'laporan';

    public function iku()
    {
        return $this->belongsTo(Iku::class,'iku_id');
    }

    public function tahapan()
    {
        return $this->belongsTo(Tahapan::class, 'tahapan_id');
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
