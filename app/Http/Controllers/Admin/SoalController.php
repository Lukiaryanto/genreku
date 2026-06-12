<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;

class SoalController extends Controller
{
    public function edit(Soal $soal)
    {
        return view('admin.soal_edit', ['soal' => $soal, 'title' => 'Edit Soal']);
    }

    public function create()
    {
        return view('admin.tambah_soal', ['title' => 'Tambah Soal']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'nullable|string',
            'opsi_b' => 'nullable|string',
            'opsi_c' => 'nullable|string',
            'opsi_d' => 'nullable|string',
            'jawaban_benar' => 'required|in:a,b,c,d',
            'kategori' => 'required|in:public_speaking,wawasan_genre,kepemimpinan',
        ]);

        Soal::create($data);

        return redirect()->route('admin.data_soal')->with('success', 'Soal berhasil ditambahkan.');
    }

    public function update(Request $request, Soal $soal)
    {
        $data = $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'nullable|string',
            'opsi_b' => 'nullable|string',
            'opsi_c' => 'nullable|string',
            'opsi_d' => 'nullable|string',
            'jawaban_benar' => 'required|in:a,b,c,d',
            'kategori' => 'required|in:public_speaking,wawasan_genre,kepemimpinan',
        ]);

        $soal->update($data);

        return redirect()->route('admin.data_soal')->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Soal $soal)
    {
        $soal->delete();
        return redirect()->route('admin.data_soal')->with('success', 'Soal berhasil dihapus.');
    }
}
