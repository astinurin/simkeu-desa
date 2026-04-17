<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendapatanModel extends Model
{
    protected $table = 'pendapatan';

    protected $fillable = [
        'user_id',
        'kategori_pendapatan',
        'jenis_pendapatan',
        'pagu',
        'tanggal',
        'dokumen',
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi one-to-one ke realisasi
    public function realisasi()
    {
        return $this->hasOne(RealisasiPendapatanModel::class, 'pendapatan_id');
    }
}