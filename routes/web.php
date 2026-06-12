<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PesertaController;
use App\Models\User;
use App\Models\Soal;
use App\Http\Controllers\Admin\SoalController;
use App\Http\Controllers\PenilaianController;

Route::get('/', function () {
    return view('home', [
        'title' => 'Home Page',
    ]);
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'About Page',
    ]);
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');

// Simple placeholders for role dashboards so redirects work
Route::get('/admin', function () {
    $total_peserta = \App\Models\Peserta::count();
    $sudah_tes = \App\Models\Penilaian::where('kategori', 'tes_soal')->distinct('peserta_id')->count('peserta_id');
    $belum_tes = $total_peserta - $sudah_tes;
    
    $persen_sudah = $total_peserta > 0 ? round(($sudah_tes / $total_peserta) * 100, 1) : 0;
    $persen_belum = $total_peserta > 0 ? round(($belum_tes / $total_peserta) * 100, 1) : 0;

    $pendaftar_terbaru = \App\Models\Peserta::with(['hasilFuzzies' => function($q) {
        $q->where('kategori', 'tes_soal');
    }])->orderBy('created_at', 'desc')->take(5)->get();

    return view('admin.dashboard_admin', [
        'title' => 'Admin Dashboard', 
        'total_peserta' => $total_peserta,
        'sudah_tes' => $sudah_tes,
        'belum_tes' => $belum_tes,
        'persen_sudah' => $persen_sudah,
        'persen_belum' => $persen_belum,
        'pendaftar_terbaru' => $pendaftar_terbaru
    ]);
})->middleware('auth')->name('admin.dashboard');

// Data Nilai (Tests) page for admin
Route::get('/admin/data-nilai', function () {
    $users = App\Models\User::with('peserta')->where('role', 'peserta')->paginate(15);

    // collect peserta ids
    $pesertaIds = $users->pluck('peserta')->filter()->map(fn($p) => $p->id)->all();

    $latestNilai = [];
    if (! empty($pesertaIds)) {
        $nilaiRows = App\Models\Nilai::whereIn('peserta_id', $pesertaIds)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('peserta_id');

        foreach ($nilaiRows as $pid => $rows) {
            $latestNilai[$pid] = $rows->first();
        }
    }

    return view('admin.data_nilai', ['title' => 'Data Nilai', 'users' => $users, 'latestNilai' => $latestNilai]);
})->middleware('auth')->name('admin.data_nilai');

// Data Soal page for admin (pass soal data)
Route::get('/admin/data-soal', function () {
    $soals = Soal::orderBy('id')->get();
    return view('admin.data_soal', ['title' => 'Data Soal', 'soals' => $soals]);
})->middleware('auth')->name('admin.data_soal');

// Admin soal edit/update/delete
Route::get('/admin/data-soal/{soal}/edit', [SoalController::class, 'edit'])
    ->middleware('auth')
    ->name('admin.soal.edit');

Route::put('/admin/data-soal/{soal}', [SoalController::class, 'update'])
    ->middleware('auth')
    ->name('admin.soal.update');

Route::delete('/admin/data-soal/{soal}', [SoalController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.soal.destroy');

// Admin soal create/store
Route::get('/admin/data-soal/create', [SoalController::class, 'create'])
    ->middleware('auth')
    ->name('admin.soal.create');

Route::post('/admin/data-soal', [SoalController::class, 'store'])
    ->middleware('auth')
    ->name('admin.soal.store');

Route::get('/users', [UserController::class, 'index'])->name('admin.users.index')->middleware('auth');
Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create')->middleware('auth');
Route::post('/users', [UserController::class, 'store'])->name('admin.users.store')->middleware('auth');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit')->middleware('auth');
Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update')->middleware('auth');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy')->middleware('auth');

Route::get('/juri', function () {
    $user = Illuminate\Support\Facades\Auth::user();
    $juriId = $user->juri?->id;
    $pesertas = App\Models\Peserta::with('penilaians')->get();
    
    $totalPeserta = $pesertas->count();
    $dinilai = 0;
    $rataRataTotal = 0;
    $nilaiCount = 0;
    $belumDinilaiList = [];

    foreach ($pesertas as $p) {
        $penilaianJuri = $p->penilaians->where('juri_id', $juriId);
        if ($juriId === null) {
            // Fallback for user juri but no juri record, count any juri
            $penilaianJuri = $p->penilaians->whereNotNull('juri_id');
        }

        if ($penilaianJuri->count() > 0) {
            $dinilai++;
            foreach ($penilaianJuri as $nj) {
                $avg = ($nj->public_speaking + $nj->wawasan_genre + $nj->kepemimpinan) / 3;
                $rataRataTotal += $avg;
                $nilaiCount++;
            }
        } else {
            $nilaiTesDb = $p->penilaians->where('kategori', 'tes_soal')->first();
            $nilaiTes = $nilaiTesDb ? round(($nilaiTesDb->public_speaking + $nilaiTesDb->wawasan_genre + $nilaiTesDb->kepemimpinan) / 3) : 0;
            
            $belumDinilaiList[] = (object)[
                'id' => $p->id,
                'nama' => $p->nama ?? $p->user?->name ?? 'Peserta',
                'asal' => $p->asal_instansi ?? '-',
                'nilai_tes' => $nilaiTes,
            ];
        }
    }

    $rataRata = $nilaiCount > 0 ? round($rataRataTotal / $nilaiCount, 1) : 0;
    $belumDinilai = $totalPeserta - $dinilai;

    return view('juri.dashboard', [
        'title' => 'Dashboard Juri',
        'totalPeserta' => $totalPeserta,
        'dinilai' => $dinilai,
        'belumDinilai' => $belumDinilai,
        'rataRata' => $rataRata,
        'belumDinilaiList' => collect($belumDinilaiList)
    ]);
})->middleware('auth')->name('juri.dashboard');

// Juri: daftar peserta
Route::get('/juri/daftar-peserta', function () {
    $pesertas = App\Models\Peserta::with(['user', 'penilaians'])->get();
    return view('juri.daftar_peserta', ['title' => 'Daftar Peserta', 'pesertas' => $pesertas]);
})->middleware('auth')->name('juri.daftar_peserta');

Route::get('/peserta', function () {
    $user = Auth::user();
    $peserta = $user->peserta;
    
    // Ambil hasil seleksi terbaru jika ada
    $hasilSeleksi = null;
    if ($peserta) {
        $hasilSeleksi = $peserta->hasilFuzzies()->latest()->first();
    }

    return view('peserta.dashboard_peserta', [
        'title' => 'Peserta Dashboard',
        'peserta' => $peserta,
        'hasilSeleksi' => $hasilSeleksi
    ]);
})->middleware('auth')->name('peserta.dashboard');

// Ujian (soal) for peserta
Route::get('/peserta/soal', [\App\Http\Controllers\Peserta\UjianController::class, 'show'])
    ->middleware('auth')
    ->name('peserta.soal');

Route::post('/peserta/soal', [\App\Http\Controllers\Peserta\UjianController::class, 'submit'])
    ->middleware('auth')
    ->name('peserta.soal.submit');

// Peserta biodata edit routes
Route::get('/peserta/biodata/edit', [PesertaController::class, 'edit'])
    ->name('peserta.biodata.edit')
    ->middleware('auth');
Route::put('/peserta/biodata', [PesertaController::class, 'update'])
    ->name('peserta.biodata.update')
    ->middleware('auth');

Route::get('/pimpinan', function () {
    // Hitung statistik untuk ringkasan
    $totalPendaftar = \App\Models\Peserta::count();
    $lolosSeleksi = \App\Models\Peserta::whereIn('status_seleksi', ['Lolos', 'Lulus', 'Lolos Seleksi'])->count();
    $gugur = \App\Models\Peserta::whereIn('status_seleksi', ['Gugur', 'Tidak Lulus', 'Gagal'])->count();
    $sedangProses = $totalPendaftar - $lolosSeleksi - $gugur;

    // Show a summary page for pimpinan: list peserta dan nilai terbaru mereka
    $users = App\Models\User::with('peserta')->where('role', 'peserta')->paginate(20);

    $pesertaIds = $users->pluck('peserta')->filter()->map(fn($p) => $p->id)->all();

    return view('pimpinan.ringkasan_peserta', [
        'title' => 'Ringkasan Peserta', 
        'users' => $users, 
        'stats' => (object)[
            'total' => $totalPendaftar,
            'lolos' => $lolosSeleksi,
            'proses' => $sedangProses,
            'gugur' => $gugur
        ]
    ]);
})->middleware('auth')->name('pimpinan.ringkasan');

// Additional pimpinan pages referenced by the pimpinan sidebar
Route::get('/pimpinan/daftar-peserta', function () {
    $users = App\Models\User::with('peserta')->where('role', 'peserta')->get();
    return view('pimpinan.daftar_peserta', ['title' => 'Daftar Peserta', 'users' => $users]);
})->middleware('auth')->name('pimpinan.daftar_peserta');

Route::get('/pimpinan/rekap-nilai', function () {
    $pesertas = App\Models\Peserta::with(['user', 'penilaians', 'hasilFuzzies'])->get();
    return view('pimpinan.rekap_nilai', [
        'title' => 'Laporan Rekapitulasi',
        'pesertas' => $pesertas
    ]);
})->middleware('auth')->name('pimpinan.rekap_nilai');

Route::get('/pimpinan/download', function () {
    // placeholder download page (could trigger export)
    return view('pimpinan.download', ['title' => 'Unduh Laporan']);
})->middleware('auth')->name('pimpinan.download');

// Admin routes for peserta detail/edit/delete
Route::get('/admin/peserta/{peserta}', [\App\Http\Controllers\Admin\PesertaController::class, 'show'])
    ->middleware('auth')
    ->name('admin.peserta.show');

Route::put('/admin/peserta/{peserta}', [\App\Http\Controllers\Admin\PesertaController::class, 'update'])
    ->middleware('auth')
    ->name('admin.peserta.update');

Route::delete('/admin/peserta/{peserta}', [\App\Http\Controllers\Admin\PesertaController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.peserta.destroy');

// Admin Juri CRUD
Route::get('/admin/juri', [\App\Http\Controllers\Admin\JuriController::class, 'index'])
    ->middleware('auth')
    ->name('admin.juri.index');

Route::get('/admin/juri/create', [\App\Http\Controllers\Admin\JuriController::class, 'create'])
    ->middleware('auth')
    ->name('admin.juri.create');

Route::post('/admin/juri', [\App\Http\Controllers\Admin\JuriController::class, 'store'])
    ->middleware('auth')
    ->name('admin.juri.store');

Route::get('/admin/juri/{juri}/edit', [\App\Http\Controllers\Admin\JuriController::class, 'edit'])
    ->middleware('auth')
    ->name('admin.juri.edit');

Route::put('/admin/juri/{juri}', [\App\Http\Controllers\Admin\JuriController::class, 'update'])
    ->middleware('auth')
    ->name('admin.juri.update');

Route::delete('/admin/juri/{juri}', [\App\Http\Controllers\Admin\JuriController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.juri.destroy');

// Admin Pimpinan CRUD
Route::get('/admin/pimpinan', [\App\Http\Controllers\Admin\PimpinanController::class, 'index'])
    ->middleware('auth')
    ->name('admin.data_pimpinan.index');

Route::get('/admin/pimpinan/create', [\App\Http\Controllers\Admin\PimpinanController::class, 'create'])
    ->middleware('auth')
    ->name('admin.pimpinan.create');

Route::post('/admin/pimpinan', [\App\Http\Controllers\Admin\PimpinanController::class, 'store'])
    ->middleware('auth')
    ->name('admin.pimpinan.store');

Route::get('/admin/pimpinan/{pimpinan}/edit', [\App\Http\Controllers\Admin\PimpinanController::class, 'edit'])
    ->middleware('auth')
    ->name('admin.pimpinan.edit');

Route::put('/admin/pimpinan/{pimpinan}', [\App\Http\Controllers\Admin\PimpinanController::class, 'update'])
    ->middleware('auth')
    ->name('admin.pimpinan.update');

Route::delete('/admin/pimpinan/{pimpinan}', [\App\Http\Controllers\Admin\PimpinanController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.pimpinan.destroy');


//Admin Klasifikasi Potensi
use App\Http\Controllers\KlasifikasiController;

Route::get('/admin/klasifikasi', [KlasifikasiController::class, 'index'])
    ->middleware('auth')
    ->name('admin.klasifikasi.index');

Route::get('/admin/klasifikasi/{id}/detail', [KlasifikasiController::class, 'show'])
    ->middleware('auth')
    ->name('admin.klasifikasi.show');

Route::get('/admin/klasifikasi/create', [KlasifikasiController::class, 'create'])
    ->middleware('auth')
    ->name('admin.klasifikasi.create');

Route::post('/admin/klasifikasi', [KlasifikasiController::class, 'store'])
    ->middleware('auth')
    ->name('admin.klasifikasi.store');

Route::get('/admin/klasifikasi/{klasifikasi}/edit', [KlasifikasiController::class, 'edit'])
    ->middleware('auth')
    ->name('admin.klasifikasi.edit');

Route::put('/admin/klasifikasi/{klasifikasi}', [KlasifikasiController::class, 'update'])
    ->middleware('auth')
    ->name('admin.klasifikasi.update');

Route::delete('/admin/klasifikasi/{klasifikasi}', [KlasifikasiController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.klasifikasi.destroy');     

// Admin Fuzzy Config
Route::get('/admin/fuzzy-config', [\App\Http\Controllers\Admin\FuzzyConfigController::class, 'index'])
    ->middleware('auth')
    ->name('admin.fuzzy_config.index');

Route::put('/admin/fuzzy-config', [\App\Http\Controllers\Admin\FuzzyConfigController::class, 'update'])
    ->middleware('auth')
    ->name('admin.fuzzy_config.update');

// Penilaian routes
Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index')->middleware('auth');
Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store')->middleware('auth');
Route::get('/penilaian/{penilaian}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit')->middleware('auth');
Route::put('/penilaian/{penilaian}', [PenilaianController::class, 'update'])->name('penilaian.update')->middleware('auth');
Route::delete('/penilaian/{penilaian}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy')->middleware('auth');

// Juri input wawancara
Route::get('/juri/wawancara', [\App\Http\Controllers\PenilaianController::class, 'index'])
    ->middleware('auth')
    ->name('juri.input_wawancara');


// Juri input project
Route::get('/juri/project', [\App\Http\Controllers\PenilaianController::class, 'indexProject'])
    ->middleware('auth')
    ->name('juri.input_project');

Route::post('/juri/project', [\App\Http\Controllers\PenilaianController::class, 'storeProject'])
    ->middleware('auth')
    ->name('juri.input_project.store');
