<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealisasiBelanjaModel extends Model
{
    protected $table = 'realisasi_belanja';

    protected $fillable = [
        'belanja_id',
        'realisasi',
        'sisa',
        'persentase'
    ];

    public function belanja()
    {
        return $this->belongsTo(BelanjaModel::class, 'belanja_id');
    }
}