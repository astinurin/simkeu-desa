<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealisasiPendapatanModel extends Model
{
    protected $table = 'realisasi_pendapatan';

    protected $fillable = [
        'pendapatan_id',
        'realisasi',
        'sisa',
        'persentase'
    ];

    // relasi ke pendapatan
    public function pendapatan()
    {
        return $this->belongsTo(PendapatanModel::class, 'pendapatan_id');
    }
}