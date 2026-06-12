<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penilaian;
use App\Models\Soal;

class UjianController extends Controller
{
    /**
     * Show the MCQ page for peserta.
     */
    public function show()
    {
        // Ambil soal dari database
        $questions = Soal::orderBy('id')->get();

        // Timer Logic: Simpan waktu berakhir di session agar tidak reset saat refresh
        $endTime = session('exam_end_time');
        if (!$endTime) {
            $endTime = now()->addMinutes(45)->timestamp;
            session(['exam_end_time' => $endTime]);
        }

        $timeLeft = $endTime - now()->timestamp;
        if ($timeLeft < 0) $timeLeft = 0;

        return view('peserta.soal', [
            'title' => 'Ujian Pilihan Ganda',
            'questions' => $questions,
            'timeLeft' => $timeLeft,
        ]);
    }

    /**
     * Handle submission, compute score and store in nilai table.
     */
    public function submit(Request $request, \App\Services\SugenoService $sugenoService)
    {
        $data = $request->validate([
            'answers' => 'required|array',
        ]);

        $answers = $data['answers']; // array: [ soal_id => 'a'|'b'.. ]

        // Ambil soal yang dijawab dari DB
        $soalIds = array_map('intval', array_keys($answers));
        $soals = Soal::whereIn('id', $soalIds)->get()->keyBy('id');

        // compute totals and correct counts per kategori
        $categories = ['public_speaking', 'wawasan_genre', 'kepemimpinan'];
        $totals = array_fill_keys($categories, 0);
        $corrects = array_fill_keys($categories, 0);

        foreach ($answers as $qid => $choice) {
            $id = (int)$qid;
            if (!isset($soals[$id])) continue;

            $soal = $soals[$id];
            $cat = $soal->kategori ?? null;
            // normalize category mapping if stored differently
            // expect kategori values to be 'public_speaking', 'wawasan_genre', or 'kepemimpinan'
            if (! in_array($cat, $categories)) {
                // try mapping legacy labels
                $map = [
                    'public_speaking' => 'public_speaking',
                    'wawasan_genre' => 'wawasan_genre',
                    'kepemimpinan' => 'kepemimpinan',
                ];
                $cat = $map[$cat] ?? null;
            }

            if ($cat && array_key_exists($cat, $totals)) {
                $totals[$cat]++;
                if (strtolower($choice) === strtolower($soal->jawaban_benar)) {
                    $corrects[$cat]++;
                }
            }
        }

        // compute percentage scores per category (integer 0-100)
        $scores = [];
        foreach ($categories as $c) {
            $scores[$c] = $totals[$c] > 0 ? (int) round(($corrects[$c] / $totals[$c]) * 100) : 0;
        }

        $user = Auth::user();

        // find peserta id related to user
        $pesertaId = optional($user->peserta)->id;

        if (!$pesertaId) {
            return back()->with('error', 'Data peserta tidak ditemukan.');
        }

        // store results in penilaian table as kategori 'tes_soal'
        Penilaian::create([
            'peserta_id' => $pesertaId,
            'juri_id' => null,
            'kategori' => 'tes_soal',
            'public_speaking' => $scores['public_speaking'],
            'wawasan_genre' => $scores['wawasan_genre'],
            'kepemimpinan' => $scores['kepemimpinan'],
        ]);

        // Hitung skor Sugeno secara otomatis
        try {
            $sugenoService->processPeserta($pesertaId, 'tes_soal');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal memproses skor Sugeno: ' . $e->getMessage());
        }

        $summary = sprintf(
            'Ujian selesai. Skor - Public Speaking: %d, Wawasan Genre: %d, Kepemimpinan: %d',
            $scores['public_speaking'],
            $scores['wawasan_genre'],
            $scores['kepemimpinan']
        );

        // Clear session timer
        session()->forget('exam_end_time');

        return redirect()->route('peserta.dashboard')->with('success', $summary);
    }
}
