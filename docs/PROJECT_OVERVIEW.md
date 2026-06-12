# Project Overview — ringkasan keseluruhan aplikasi

Dokumen ini menjelaskan struktur proyek Laravel yang sedang Anda kerjakan, file-file penting, alur data utama, cara menjalankan aplikasi di lingkungan development, dan titik integrasi untuk mengimplementasikan algoritma Sugeno fuzzy.

Catatan: semua instruksi menggunakan PowerShell (Windows) sesuai lingkungan Anda.

---

## 1. Gambaran singkat

Aplikasi ini dibangun menggunakan Laravel (PHP). Fungsionalitas utama:

- Manajemen user dengan role (admin, peserta, juri, pimpinan).
- Modul peserta mengikuti ujian pilihan ganda (MCQ) dan hasilnya disimpan.
- Modul juri untuk memasukkan nilai wawancara dan project.
- Model `Penilaian` digunakan untuk menyimpan penilaian per kategori (tes_soal, wawancara, project).

Root workspace: `d:\laragon\www\laravel12`

## 2. Struktur folder & file penting

- `app/Models/`
    - `User.php` (model user, relasi ke `Peserta`, `Juri`)
    - `Peserta.php` (data peserta, tanggal_lahir, alamat, asal_instansi)
    - `Juri.php` (data juri, relasi ke user)
    - `Penilaian.php` (model untuk menyimpan skor per kategori)
    - `Soal.php` (soal MCQ, kolom `kategori` menentukan target kategori)
    - `Pimpinan.php`, `Nilai.php` (jika ada: model untuk nilai lama atau khusus)

- `app/Http/Controllers/`
    - `Peserta\UjianController.php` — menampilkan soal, memproses submit MCQ, menghitung skor per kategori, menyimpan `Penilaian` kategori `tes_soal`.
    - `PenilaianController.php` — endpoint untuk juri menyimpan `wawancara` dan `project` (store, storeProject).
    - `Admin/*` — controller CRUD untuk User, Juri, Soal, Pimpinan, dsb.

- `database/migrations/`
    - `2026_05_07_063025_create_penilaians_table.php` — skema tabel `penilaian`.
    - Beberapa migrasi lain untuk users/peserta/juri/pimpinan/soal.

- `resources/views/`
    - `peserta/soal.blade.php` — halaman ujian MCQ (form submit jawaban).
    - `juri/input_wawancara.blade.php`, `juri/input_project.blade.php` — form juri.
    - `admin/*` — berbagai tampilan admin.
    - `components/*` — layout & komponen seperti `admin-layout`, `juri-sidebar`, `peserta-layout`.

- `routes/web.php` — definisi rute untuk aplikasi.

- `docs/` — dokumentasi yang sudah dibuat: `TEST_PENILAIAN.md`, `PENILAIAN_OVERVIEW.md`, dan file ini `PROJECT_OVERVIEW.md`.

## 3. Alur data utama (ringkas)

1. Peserta membuka `GET /peserta/soal` (UjianController@show) -> menerima soal.
2. Peserta submit jawaban `POST /peserta/soal` (UjianController@submit):
    - controller memvalidasi jawaban, menghitung skor per kategori berdasarkan `soal.kategori`,
    - menyimpan satu baris ke tabel `penilaian` dengan `kategori = 'tes_soal'`, `juri_id = NULL`.
3. Juri mengakses form `juri/input_wawancara` atau `juri/input_project` dan mengirim `POST /penilaian` atau `POST /juri/project`:
    - `PenilaianController::store()` memvalidasi dan membuat record `penilaian` dengan `juri_id = <id juri>`.

## 4. Cara menjalankan aplikasi (development)

1. Install dependensi (jika belum):

```powershell
cd d:\laragon\www\laravel12
composer install
npm install
npm run build # atau dev
```

2. Setup environment (.env): pastikan DB connection, APP_KEY, dsb sudah diatur.

3. Jalankan migrasi:

```powershell
php artisan migrate
```

4. Jalankan server dev:

```powershell
php artisan serve --host=127.0.0.1 --port=8000
```

5. (Optional) Gunakan `php artisan tinker` untuk inspeksi DB cepat.

## 5. Debugging: jika data `penilaian` tidak tersimpan pada submit MCQ

Langkah cepat:

- Pastikan peserta yang login memiliki row `peserta` terkait (user->peserta tidak null).
- Periksa `storage/logs/laravel.log` setelah submit untuk error.
- Periksa struktur tabel `penilaian`:
    - gunakan `php artisan tinker` lalu `DB::select('DESCRIBE penilaian');`
- Tambahkan logging sementara di `UjianController::submit()` tepat sebelum `Penilaian::create()`:

```php
\Log::debug('Ujian submit', ['peserta_id' => $pesertaId, 'scores' => $scores]);
```

Lalu baca `storage/logs/laravel.log`.

## 6. Titik integrasi untuk Sugeno fuzzy

- Data input: ambil nilai `penilaian` per peserta (kategori `tes_soal`, `wawancara`, `project`). Biasanya gunakan record terbaru per kategori atau aggregasi (rata-rata untuk wawancara jika banyak juri).
- Buat service/command yang mengambil input, menjalankan engine Sugeno, dan menyimpan hasil ke tabel baru (mis. `final_scores`).

Rekomendasi implementasi:

- Buat model `FinalScore` dan migrasi `final_scores`.
- Buat Artisan command `compute:final-scores` yang memproses semua peserta dan menulis hasil Sugeno.
- Implementasikan evaluator Sugeno di `app/Services/SugenoEvaluator.php` (atau panggil microservice eksternal jika diinginkan).

## 7. Test otomatis

- Buat feature test untuk submit MCQ (simulate user login, POST answers, assert `penilaian` created).
- Buat unit test untuk Sugeno evaluator (input->output deterministik) jika Anda mengimplementasikan evaluator PHP.

## 8. Catatan keamanan & validasi

- Validasi input range pada form juri sudah diterapkan (0-100).
- Pastikan hanya role `juri` yang dapat mengakses route penyimpanan juri.

## 9. Next steps yang bisa saya bantu

- Implementasikan evaluator Sugeno sederhana di PHP dan unit tests.
- Buat migrasi + model `final_scores` dan Artisan command untuk batch compute.
- Tambahkan monitoring/logging lebih baik (Sentry atau log channel khusus) saat pipeline compute.

---

Kalau mau, saya bisa langsung mulai membuat salah satu: evaluator PHP, migrasi `final_scores` + model + command, atau microservice Sugeno. Pilih yang Anda ingin kerjakan sekarang.
