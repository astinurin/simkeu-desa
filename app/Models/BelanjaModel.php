<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BelanjaModel extends Model
{
    protected $table = 'belanja';

    protected $fillable = [
        'user_id',
        'tanggal',
        'jenis_kegiatan',
        'bidang',
        'pagu',
        'realisasi_belanja',
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi one-to-one ke realisasi
    public function realisasi()
    {
        return $this->hasOne(RealisasiBelanjaModel::class, 'belanja_id');
    }

    // relasi one-to-many ke dokumentasi
    public function dokumentasi()
    {
        return $this->hasMany(DokumentasiKegiatanModel::class, 'belanja_id');
    }
}
