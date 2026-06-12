<?php

namespace App\Services;

use App\Models\FuzzyConfig;
use App\Models\FuzzyDetail;
use App\Models\HasilFuzzy;
use App\Models\Penilaian;
use App\Models\Peserta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SugenoService
{
    protected array $cfg;

    public function __construct()
    {
        $this->cfg = FuzzyConfig::resolvedMap();
    }

    /**
     * Hitung nilai membership untuk sebuah score (0-100)
     * Range diambil dari config dinamis (DB / default).
     */
    public function fuzzify($score)
    {
        $rendah = 0;
        $sedang = 0;
        $tinggi = 0;

        $rendahMax  = $this->cfg['rendah_max'];   // default 50
        $sedangMin  = $this->cfg['sedang_min'];    // default 40
        $sedangPeak = $this->cfg['sedang_peak'];   // default 60
        $sedangMax  = $this->cfg['sedang_max'];    // default 80
        $tinggiMin  = $this->cfg['tinggi_min'];    // default 75

        // Rendah (Model Bahu Kiri sesuai rumus User)
        // 1 jika x <= sedangMin
        // (rendahMax - x) / (rendahMax - sedangMin) jika sedangMin < x < rendahMax
        if ($score <= $sedangMin) {
            $rendah = 1;
        } elseif ($score > $sedangMin && $score < $rendahMax) {
            $rendah = ($rendahMax - $score) / ($rendahMax - $sedangMin);
        } else {
            $rendah = 0;
        }

        // Sedang (sedangMin - sedangPeak - sedangMax)  — segitiga
        if ($score <= $sedangMin || $score >= $sedangMax) {
            $sedang = 0;
        } elseif ($score > $sedangMin && $score <= $sedangPeak) {
            $sedang = ($score - $sedangMin) / ($sedangPeak - $sedangMin);
        } elseif ($score > $sedangPeak && $score < $sedangMax) {
            $sedang = ($sedangMax - $score) / ($sedangMax - $sedangPeak);
        }

        // Tinggi (tinggiMin - 100)
        if ($score <= $tinggiMin) {
            $tinggi = 0;
        } elseif ($score > $tinggiMin && $score < 100) {
            $tinggi = ($score - $tinggiMin) / (100 - $tinggiMin);
        } else { // >= 100
            $tinggi = 1;
        }

        return [
            'rendah' => round($rendah, 4),
            'sedang' => round($sedang, 4),
            'tinggi' => round($tinggi, 4)
        ];
    }

    /**
     * Evaluasi 27 rules Sugeno dan hasilkan nilai akhir.
     */
    public function evaluate($ps, $wg, $kp)
    {
        $outKurang = $this->cfg['out_kurang']; // default 0.4
        $outCukup  = $this->cfg['out_cukup'];  // default 0.6
        $outSangat = $this->cfg['out_sangat']; // default 0.8

        $rules = [
            ['ps' => 'rendah', 'wg' => 'rendah', 'kp' => 'rendah', 'out' => $outKurang],
            ['ps' => 'rendah', 'wg' => 'rendah', 'kp' => 'sedang', 'out' => $outKurang],
            ['ps' => 'rendah', 'wg' => 'rendah', 'kp' => 'tinggi', 'out' => $outCukup],
            ['ps' => 'rendah', 'wg' => 'sedang', 'kp' => 'rendah', 'out' => $outKurang],
            ['ps' => 'rendah', 'wg' => 'sedang', 'kp' => 'sedang', 'out' => $outCukup],
            ['ps' => 'rendah', 'wg' => 'sedang', 'kp' => 'tinggi', 'out' => $outCukup],
            ['ps' => 'rendah', 'wg' => 'tinggi', 'kp' => 'rendah', 'out' => $outCukup],
            ['ps' => 'rendah', 'wg' => 'tinggi', 'kp' => 'sedang', 'out' => $outCukup],
            ['ps' => 'rendah', 'wg' => 'tinggi', 'kp' => 'tinggi', 'out' => $outSangat],
            ['ps' => 'sedang', 'wg' => 'rendah', 'kp' => 'rendah', 'out' => $outKurang],
            ['ps' => 'sedang', 'wg' => 'rendah', 'kp' => 'sedang', 'out' => $outCukup],
            ['ps' => 'sedang', 'wg' => 'rendah', 'kp' => 'tinggi', 'out' => $outCukup],
            ['ps' => 'sedang', 'wg' => 'sedang', 'kp' => 'rendah', 'out' => $outCukup],
            ['ps' => 'sedang', 'wg' => 'sedang', 'kp' => 'sedang', 'out' => $outCukup],
            ['ps' => 'sedang', 'wg' => 'sedang', 'kp' => 'tinggi', 'out' => $outSangat],
            ['ps' => 'sedang', 'wg' => 'tinggi', 'kp' => 'rendah', 'out' => $outCukup],
            ['ps' => 'sedang', 'wg' => 'tinggi', 'kp' => 'sedang', 'out' => $outSangat],
            ['ps' => 'sedang', 'wg' => 'tinggi', 'kp' => 'tinggi', 'out' => $outSangat],
            ['ps' => 'tinggi', 'wg' => 'rendah', 'kp' => 'rendah', 'out' => $outCukup],
            ['ps' => 'tinggi', 'wg' => 'rendah', 'kp' => 'sedang', 'out' => $outCukup],
            ['ps' => 'tinggi', 'wg' => 'rendah', 'kp' => 'tinggi', 'out' => $outSangat],
            ['ps' => 'tinggi', 'wg' => 'sedang', 'kp' => 'rendah', 'out' => $outCukup],
            ['ps' => 'tinggi', 'wg' => 'sedang', 'kp' => 'sedang', 'out' => $outSangat],
            ['ps' => 'tinggi', 'wg' => 'sedang', 'kp' => 'tinggi', 'out' => $outSangat],
            ['ps' => 'tinggi', 'wg' => 'tinggi', 'kp' => 'rendah', 'out' => $outSangat],
            ['ps' => 'tinggi', 'wg' => 'tinggi', 'kp' => 'sedang', 'out' => $outSangat],
            ['ps' => 'tinggi', 'wg' => 'tinggi', 'kp' => 'tinggi', 'out' => $outSangat],
        ];

        $sumAlphaOutput = 0;
        $sumAlpha = 0;

        foreach ($rules as $rule) {
            $alpha = min(
                $ps[$rule['ps']],
                $wg[$rule['wg']],
                $kp[$rule['kp']]
            );

            if ($alpha > 0) {
                $sumAlphaOutput += ($alpha * $rule['out']);
                $sumAlpha += $alpha;
            }
        }

        $z = ($sumAlpha > 0) ? ($sumAlphaOutput / $sumAlpha) : 0;
        $z = round($z, 2);

        // Interpretasi — threshold juga dinamis
        $thresholdKurang = $this->cfg['status_kurang_max']; // default 0.53
        $thresholdCukup  = $this->cfg['status_cukup_max'];  // default 0.67

        $status = 'Tidak Diketahui';
        if ($z >= 0.40 && $z <= $thresholdKurang) {
            $status = 'Kurang Kompeten';
        } elseif ($z > $thresholdKurang && $z <= $thresholdCukup) {
            $status = 'Cukup Kompeten';
        } elseif ($z > $thresholdCukup) {
            $status = 'Sangat Kompeten';
        }

        return [
            'nilai_hasil' => $z,
            'status' => $status
        ];
    }

    /**
     * Hitung nilai akhir untuk peserta dan kategori tertentu.
     * @param int $pesertaId
     * @param string $kategori
     */
    public function processPeserta($pesertaId, $kategori)
    {
        // Ambil nilai terbaru untuk kategori ini
        $penilaian = Penilaian::where('peserta_id', $pesertaId)
            ->where('kategori', $kategori)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$penilaian) {
            Log::warning("Tidak ada nilai untuk peserta {$pesertaId} kategori {$kategori}");
            return false;
        }

        DB::beginTransaction();
        try {
            // Hapus data fuzzy lama untuk kategori ini
            FuzzyDetail::where('peserta_id', $pesertaId)->where('kategori', $kategori)->delete();
            HasilFuzzy::where('peserta_id', $pesertaId)->where('kategori', $kategori)->delete();

            // 1. Fuzzify
            $psFuzzy = $this->fuzzify($penilaian->public_speaking);
            $wgFuzzy = $this->fuzzify($penilaian->wawasan_genre);
            $kpFuzzy = $this->fuzzify($penilaian->kepemimpinan);

            // Simpan detail (Public Speaking)
            FuzzyDetail::create([
                'peserta_id' => $pesertaId,
                'kategori' => $kategori,
                'komponen' => 'public_speaking',
                'nilai_asli' => $penilaian->public_speaking,
                'rendah' => $psFuzzy['rendah'],
                'sedang' => $psFuzzy['sedang'],
                'tinggi' => $psFuzzy['tinggi'],
            ]);

            // Simpan detail (Wawasan GenRe)
            FuzzyDetail::create([
                'peserta_id' => $pesertaId,
                'kategori' => $kategori,
                'komponen' => 'wawasan_genre',
                'nilai_asli' => $penilaian->wawasan_genre,
                'rendah' => $wgFuzzy['rendah'],
                'sedang' => $wgFuzzy['sedang'],
                'tinggi' => $wgFuzzy['tinggi'],
            ]);

            // Simpan detail (Kepemimpinan)
            FuzzyDetail::create([
                'peserta_id' => $pesertaId,
                'kategori' => $kategori,
                'komponen' => 'kepemimpinan',
                'nilai_asli' => $penilaian->kepemimpinan,
                'rendah' => $kpFuzzy['rendah'],
                'sedang' => $kpFuzzy['sedang'],
                'tinggi' => $kpFuzzy['tinggi'],
            ]);

            // 2. Evaluasi Sugeno
            $hasil = $this->evaluate($psFuzzy, $wgFuzzy, $kpFuzzy);

            // 3. Simpan Hasil
            $hasilRecord = HasilFuzzy::create([
                'peserta_id' => $pesertaId,
                'kategori' => $kategori,
                'nilai_hasil' => $hasil['nilai_hasil'],
                'status' => $hasil['status'],
            ]);

            DB::commit();
            return $hasilRecord;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error menghitung Sugeno: " . $e->getMessage());
            throw $e;
        }
    }
}
