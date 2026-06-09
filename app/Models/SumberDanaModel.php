<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumberDanaModel extends Model
{
    protected $table = 'sumber_dana';

    protected $fillable = [
        'kode',
        'nama'
    ];

    public function belanja()
    {
        return $this->belongsToMany(
            BelanjaModel::class,
            'belanja_sumber_dana',
            'sumber_dana_id',
            'belanja_id'
        )->withPivot('nominal');
    }
}
