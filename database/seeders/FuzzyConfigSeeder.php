<?php

namespace Database\Seeders;

use App\Models\FuzzyConfig;
use Illuminate\Database\Seeder;

class FuzzyConfigSeeder extends Seeder
{
    public function run(): void
    {
        $configs = [
            // Membership Function Ranges
            ['key' => 'rendah_max',  'label' => 'Rendah — Batas Atas',     'value' => 50,   'group' => 'membership', 'keterangan' => 'Batas atas fungsi keanggotaan Rendah (0 s/d nilai ini)'],
            ['key' => 'sedang_min',  'label' => 'Sedang — Batas Bawah',    'value' => 40,   'group' => 'membership', 'keterangan' => 'Batas bawah fungsi keanggotaan Sedang'],
            ['key' => 'sedang_peak', 'label' => 'Sedang — Puncak',         'value' => 60,   'group' => 'membership', 'keterangan' => 'Titik puncak (membership=1) fungsi Sedang'],
            ['key' => 'sedang_max',  'label' => 'Sedang — Batas Atas',     'value' => 80,   'group' => 'membership', 'keterangan' => 'Batas atas fungsi keanggotaan Sedang'],
            ['key' => 'tinggi_min',  'label' => 'Tinggi — Batas Bawah',    'value' => 75,   'group' => 'membership', 'keterangan' => 'Batas bawah fungsi keanggotaan Tinggi (nilai ini s/d 100)'],

            // Konstanta Output Sugeno
            ['key' => 'out_kurang',  'label' => 'Konstanta Kurang Kompeten', 'value' => 0.4, 'group' => 'output', 'keterangan' => 'Nilai Z output untuk rule Kurang Kompeten'],
            ['key' => 'out_cukup',   'label' => 'Konstanta Cukup Kompeten',  'value' => 0.6, 'group' => 'output', 'keterangan' => 'Nilai Z output untuk rule Cukup Kompeten'],
            ['key' => 'out_sangat',  'label' => 'Konstanta Sangat Kompeten', 'value' => 0.8, 'group' => 'output', 'keterangan' => 'Nilai Z output untuk rule Sangat Kompeten'],

            // Threshold Interpretasi
            ['key' => 'status_kurang_max', 'label' => 'Threshold Kurang → Cukup', 'value' => 0.53, 'group' => 'threshold', 'keterangan' => 'Batas atas nilai Z untuk status Kurang Kompeten'],
            ['key' => 'status_cukup_max',  'label' => 'Threshold Cukup → Sangat', 'value' => 0.67, 'group' => 'threshold', 'keterangan' => 'Batas atas nilai Z untuk status Cukup Kompeten'],
        ];

        foreach ($configs as $cfg) {
            FuzzyConfig::updateOrCreate(['key' => $cfg['key']], $cfg);
        }
    }
}
