<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Peserta;
use App\Models\Juri;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Role constants
    public const ROLE_ADMIN = 'admin';
    public const ROLE_JURI = 'juri';
    public const ROLE_PESERTA = 'peserta';
    public const ROLE_PIMPINAN = 'pimpinan';

    /**
     * Get available roles.
     *
     * @return array<int,string>
     */
    public static function roles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_JURI,
            self::ROLE_PESERTA,
            self::ROLE_PIMPINAN,
        ];
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    public function isJuri(): bool
    {
        return $this->hasRole(self::ROLE_JURI);
    }

    public function isPeserta(): bool
    {
        return $this->hasRole(self::ROLE_PESERTA);
    }

    public function isPimpinan(): bool
    {
        return $this->hasRole(self::ROLE_PIMPINAN);
    }

    /**
     * Get the peserta record related to this user (one-to-one).
     */
    public function peserta(): HasOne
    {
        return $this->hasOne(Peserta::class, 'user_id');
    }

    /**
     * Get all peserta records for this user (one-to-many).
     * Useful if your application allows multiple peserta per user.
     */
    public function pesertas(): HasMany
    {
        return $this->hasMany(Peserta::class, 'user_id');
    }

    /**
     * Get the juri record related to this user (one-to-one).
     */
    public function juri(): HasOne
    {
        return $this->hasOne(Juri::class, 'user_id');
    }
}
