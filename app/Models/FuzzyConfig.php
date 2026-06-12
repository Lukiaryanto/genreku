<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuzzyConfig extends Model
{
    protected $fillable = ['key', 'label', 'value', 'group', 'keterangan'];

    protected $casts = ['value' => 'float'];

    /**
     * Ambil semua config sebagai key => value map untuk dipakai SugenoService
     */
    public static function asMap(): array
    {
        return self::all()->pluck('value', 'key')->toArray();
    }

    /**
     * Ambil nilai default jika key tidak ditemukan di DB
     */
    public static function defaults(): array
    {
        return [
            // Membership: Rendah (0 - rendah_max)
            'rendah_max'      => 50,

            // Membership: Sedang (sedang_min - sedang_peak - sedang_max)
            'sedang_min'      => 40,
            'sedang_peak'     => 60,
            'sedang_max'      => 80,

            // Membership: Tinggi (tinggi_min - 100)
            'tinggi_min'      => 75,

            // Output Sugeno (konstanta Z)
            'out_kurang'      => 0.4,
            'out_cukup'       => 0.6,
            'out_sangat'      => 0.8,

            // Threshold interpretasi status
            'status_kurang_max' => 0.53,
            'status_cukup_max'  => 0.67,
        ];
    }

    /**
     * Ambil map config dari DB, fallback ke default jika belum ada data
     */
    public static function resolvedMap(): array
    {
        $fromDb = self::asMap();
        return array_merge(self::defaults(), $fromDb);
    }
}
