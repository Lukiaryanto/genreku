<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    /**
     * Explicit table name to avoid pluralization issues.
     *
     * @var string
     */
    protected $table = 'penilaian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'peserta_id',
        'juri_id',
        'kategori',
        'public_speaking',
        'wawasan_genre',
        'kepemimpinan',
    ];

      /**
     * Relation to Peserta
     */
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    /**
     * Relation to Juri
     */
    public function juri()
    {
        return $this->belongsTo(Juri::class);
    }


}
