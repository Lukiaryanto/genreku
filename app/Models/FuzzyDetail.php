<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzyDetail extends Model
{
    protected $fillable = [
        'peserta_id',
        'kategori',
        'komponen',
        'nilai_asli',
        'rendah',
        'sedang',
        'tinggi',
    ];

    /**
     * Relasi ke peserta
     */
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}