<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilFuzzy;

use App\Models\Peserta;

class KlasifikasiController extends Controller
{
    public function index()
    {
        $pesertas = Peserta::with('hasilFuzzies')->get();
        return view('admin.klasifikai_potensi', compact('pesertas'));
    }

    public function show($id)
    {
        $peserta = Peserta::with('hasilFuzzies')->findOrFail($id);
        $details = \App\Models\FuzzyDetail::where('peserta_id', $id)->get();
        
        return view('admin.klasifikasi_detail', compact('details', 'peserta'));
    }
}
