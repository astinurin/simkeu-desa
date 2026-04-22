<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealisasiBelanjaModel extends Model
{
    protected $table = 'realisasi_belanja';

    protected $fillable = [
        'belanja_id',
        'realisasi',
        'sisa_belanja',
        'total_pagu_belanja',
        'total_sisa_belanja',
        'persentase',
        'total_persentase'
    ];

    public function belanja()
    {
        return $this->belongsTo(BelanjaModel::class, 'belanja_id');
    }
}
