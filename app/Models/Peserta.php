<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peserta extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'peserta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nama',
        'tanggal_lahir',
        'no_hp',
        'jenis_kelamin',
        'alamat',
        'asal_instansi',
        'status_seleksi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get the user that owns the peserta.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all penilaians for the peserta.
     */
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    /**
     * Get all hasil fuzzies for the peserta.
     */
    public function hasilFuzzies()
    {
        return $this->hasMany(HasilFuzzy::class);
    }
}
