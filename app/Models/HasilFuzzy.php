<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilFuzzy extends Model
{
    protected $fillable = [
        'peserta_id',
        'kategori',
        'nilai_hasil',
        'status',
    ];

    /**
     * Relasi ke peserta
     */
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
