<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiKegiatanModel extends Model
{
    protected $table = 'dokumentasi_kegiatan';

    protected $fillable = [
        'belanja_id',
        'file',
        'keterangan'
    ];

    public function belanja()
    {
        return $this->belongsTo(BelanjaModel::class, 'belanja_id');
    }
}