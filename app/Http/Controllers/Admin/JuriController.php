<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Juri;
use App\Models\User;

class JuriController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('juri')->where('role', 'juri');

        // Filter Tahun
        if ($request->has('tahun') && $request->tahun != '') {
            $query->whereYear('created_at', $request->tahun);
        }

        $juris = $query->orderBy('id', 'desc')->paginate(15);

        // Ambil daftar tahun unik dari data juri
        $availableYears = User::where('role', 'juri')
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('admin.data_juri', [
            'title' => 'Data Juri', 
            'juris' => $juris,
            'availableYears' => $availableYears
        ]);
    }

    public function create(Request $request)
    {
        // provide list of users that are not yet juri
        $users = User::where('role', '!=', 'juri')->get();

        // allow pre-selecting a user via ?user_id=NN
        $preselect = $request->query('user_id');

        return view('admin.tambah_juri', ['title' => 'Tambah Juri', 'users' => $users, 'preselect' => $preselect]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'nama' => 'required|string',
            'keahlian' => 'nullable|string',
            'instansi' => 'nullable|string',
        ]);

        // Create the user with role 'juri'
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($data['password']),
            'role' => User::ROLE_JURI,
        ]);

        // Create the Juri record linked to the new user
        Juri::create([
            'user_id' => $user->id,
            'nama' => $data['nama'],
            'keahlian' => $data['keahlian'] ?? null,
            'instansi' => $data['instansi'] ?? null,
        ]);

        return redirect()->route('admin.juri.index')->with('success', 'Juri berhasil ditambahkan.');
    }

    public function edit(Juri $juri)
    {
        return view('admin.juri_edit', ['title' => 'Edit Juri', 'juri' => $juri]);
    }

    public function update(Request $request, Juri $juri)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'keahlian' => 'nullable|string',
            'instansi' => 'nullable|string',
        ]);

        $juri->update($data);

        return redirect()->route('admin.juri.index')->with('success', 'Data juri diperbarui.');
    }

    public function destroy(Juri $juri)
    {
        $user = $juri->user;
        $juri->delete();
        
        if ($user) {
            $user->delete();
        }
        
        return redirect()->route('admin.juri.index')->with('success', 'Juri beserta akun pengguna berhasil dihapus.');
    }
}
