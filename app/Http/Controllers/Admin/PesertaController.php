<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function show(Peserta $peserta)
    {
        return view('admin.peserta_detail', ['peserta' => $peserta, 'title' => 'Detail Peserta']);
    }

    public function update(Request $request, Peserta $peserta)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'tanggal_lahir' => 'nullable|date',
            'no_hp' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'asal_instansi' => 'nullable|string',
            'status_seleksi' => 'nullable|string',
        ]);

        $peserta->update($data);

        return redirect()->route('admin.peserta.show', $peserta->id)->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(Peserta $peserta)
    {
        // delete related user as well
        $user = $peserta->user;

        if (Auth::check() && $user && Auth::id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if ($user) {
            $user->delete();
        } else {
            $peserta->delete();
        }

        return redirect()->route('admin.users.index')->with('success', 'Peserta berhasil dihapus.');
    }
}
