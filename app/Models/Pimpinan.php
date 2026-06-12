<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
