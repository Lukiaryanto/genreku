<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peserta;

class PesertaController extends Controller
{
    /**
     * Show the edit form for the authenticated user's Peserta biodata.
     */
    public function edit()
    {
        $user = Auth::user();

        $peserta = $user->peserta;

        // If peserta record doesn't exist, create an empty one so user can fill it
        if (! $peserta) {
            $peserta = Peserta::create([
                'user_id' => $user->id,
                'nama' => $user->name,
                'tanggal_lahir' => null,
                'alamat' => null,
                'asal_instansi' => null,
            ]);
        }

        return view('peserta.edit', [
            'title' => 'Edit Biodata',
            'peserta' => $peserta,
        ]);
    }

    /**
     * Update the authenticated user's Peserta biodata.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $peserta = $user->peserta;

        if (! $peserta) {
            return redirect()->route('peserta.biodata.edit')->with('error', 'Data peserta tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'jenis_kelamin' => ['nullable', 'string', 'in:Laki-laki,Perempuan'],
            'alamat' => ['nullable', 'string'],
            'asal_instansi' => ['nullable', 'string', 'max:255'],
        ]);

        $peserta->update($validated);

        return redirect()->route('peserta.biodata.edit')->with('success', 'Biodata berhasil diperbarui.');
    }
}
