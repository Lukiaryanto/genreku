<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pimpinan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PimpinanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pimpinans = Pimpinan::orderBy('id', 'desc')->paginate(15);
        return view('admin.data_pimpinan', ['title' => 'Data Pimpinan', 'pimpinans' => $pimpinans]);
    }

    public function create()
    {
        return view('admin.tambah_pimpinan', ['title' => 'Tambah Pimpinan']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'password' => 'required|string|min:8',
            'jabatan' => 'nullable|string|max:255',
        ]);

        // create user for pimpinan
        $user = User::create([
            'name' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_PIMPINAN,
        ]);

        $p = Pimpinan::create([
            'user_id' => $user->id,
            'nama' => $data['nama'],
            'email' => $data['email'] ?? null,
            'jabatan' => $data['jabatan'] ?? null,
        ]);

        return redirect()->route('admin.data_pimpinan.index')->with('success', 'Pimpinan berhasil ditambahkan.');
    }

    public function edit(Pimpinan $pimpinan)
    {
        return view('admin.pimpinan_edit', ['title' => 'Edit Pimpinan', 'pimpinan' => $pimpinan]);
    }

    public function update(Request $request, Pimpinan $pimpinan)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'password' => 'nullable|string|min:8',
            'jabatan' => 'nullable|string|max:255',
        ]);

        // update pimpinan record
        $pimpinan->update([
            'nama' => $data['nama'],
            'email' => $data['email'] ?? $pimpinan->email,
            'jabatan' => $data['jabatan'] ?? $pimpinan->jabatan,
        ]);

        // sync user if linked
        if ($pimpinan->user) {
            $pimpinan->user->name = $data['nama'];
            if (! empty($data['email'])) {
                $pimpinan->user->email = $data['email'];
            }
            if (! empty($data['password'])) {
                $pimpinan->user->password = Hash::make($data['password']);
            }
            $pimpinan->user->save();
        }

        return redirect()->route('admin.data_pimpinan.index')->with('success', 'Pimpinan berhasil diupdate.');
    }

    public function destroy(Pimpinan $pimpinan)
    {
        // delete linked user if exists
        if ($pimpinan->user) {
            $pimpinan->user->delete();
        }
        $pimpinan->delete();

        return redirect()->route('admin.data_pimpinan.index')->with('success', 'Pimpinan berhasil dihapus.');
    }
}
