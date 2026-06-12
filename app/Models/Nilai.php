<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    /**
     * Explicit table name to avoid pluralization issues.
     *
     * @var string
     */
    protected $table = 'nilai';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'peserta_id',
        'juri_id',
        'nilai_tes',
        'nilai_public_speaking',
        'nilai_modul',
        'nilai_wawasan',
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
