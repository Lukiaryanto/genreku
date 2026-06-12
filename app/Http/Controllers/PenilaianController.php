<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peserta;
use App\Models\Penilaian;
use App\Services\SugenoService;

class PenilaianController extends Controller
{
    public function index()
    {
        $peserta = Peserta::orderBy('nama')->get();
        return view('juri.input_wawancara', compact('peserta'));
    }

    public function store(Request $request, SugenoService $sugenoService)
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'juri') {
            return redirect()->back()->withErrors(['auth' => 'Hanya juri yang dapat menambahkan nilai.']);
        }

        $data = $request->validate([
            'peserta_id' => 'required|exists:peserta,id',
            'kategori' => 'required|in:wawancara,project,tes_soal',
            'public_speaking' => 'required|integer|min:0|max:100',
            'wawasan_genre' => 'required|integer|min:0|max:100',
            'kepemimpinan' => 'required|integer|min:0|max:100',
        ]);

        $penilaian = Penilaian::create([
            'peserta_id' => $data['peserta_id'],
            'juri_id' => $user->juri?->id,
            'kategori' => $data['kategori'],
            'public_speaking' => $data['public_speaking'],
            'wawasan_genre' => $data['wawasan_genre'],
            'kepemimpinan' => $data['kepemimpinan'],
        ]);

        // Hitung skor Sugeno secara otomatis
        try {
            $sugenoService->processPeserta($data['peserta_id'], $data['kategori']);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal memproses skor Sugeno: ' . $e->getMessage());
        }

        // redirect to the appropriate form based on kategori
        if ($data['kategori'] === 'project') {
            return redirect()->route('juri.input_project')->with('success', 'Nilai project berhasil disimpan.');
        }

        return redirect()->route('juri.input_wawancara')->with('success', 'Nilai wawancara berhasil disimpan.');
    }

    public function indexProject()
    {
        $peserta = Peserta::orderBy('nama')->get();
        return view('juri.input_project', compact('peserta'));
    }

    /**
     * Handle project form POSTs that target /juri/project.
     * This method injects kategori='project' and delegates to store().
     */
    public function storeProject(Request $request, SugenoService $sugenoService)
    {
        // ensure kategori is set to project so store() validation accepts it
        $request->merge(['kategori' => 'project']);
        return $this->store($request, $sugenoService);
    }

    public function edit(Penilaian $penilaian)
    {
        return view('juri.penilaian_edit', compact('penilaian'));
    }

    public function update(Request $request, Penilaian $penilaian, SugenoService $sugenoService)
    {
        $data = $request->validate([
            'public_speaking' => 'required|integer|min:0|max:100',
            'wawasan_genre' => 'required|integer|min:0|max:100',
            'kepemimpinan' => 'required|integer|min:0|max:100',
        ]);

        $penilaian->update($data);

        // Hitung ulang skor Sugeno secara otomatis
        try {
            $sugenoService->processPeserta($penilaian->peserta_id, $penilaian->kategori);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal memproses skor Sugeno (Update): ' . $e->getMessage());
        }

        return redirect()->route('juri.daftar_peserta')->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy(Penilaian $penilaian, SugenoService $sugenoService)
    {
        $pesertaId = $penilaian->peserta_id;
        $kategori = $penilaian->kategori;

        $penilaian->delete();

        // Hapus juga hasil fuzzy terkait jika tidak ada lagi penilaian untuk kategori tersebut
        $remaining = Penilaian::where('peserta_id', $pesertaId)->where('kategori', $kategori)->count();
        if ($remaining === 0) {
            \App\Models\FuzzyDetail::where('peserta_id', $pesertaId)->where('kategori', $kategori)->delete();
            \App\Models\HasilFuzzy::where('peserta_id', $pesertaId)->where('kategori', $kategori)->delete();
        } else {
            // Hitung ulang berdasarkan nilai yang tersisa (jika ada juri lain yang memberi nilai)
            try {
                $sugenoService->processPeserta($pesertaId, $kategori);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Gagal memproses skor Sugeno (Delete): ' . $e->getMessage());
            }
        }

        return redirect()->route('juri.daftar_peserta')->with('success', 'Nilai berhasil dihapus.');
    }
}
