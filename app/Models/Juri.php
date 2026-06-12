<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Juri extends Model
{
    /**
     * Explicit table name since pluralization of 'juri' would be 'juris' by default.
     *
     * @var string
     */
    protected $table = 'juri';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nama',
        'keahlian',
        'instansi',
    ];

    /**
     * Juri belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
