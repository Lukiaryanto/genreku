# TEST_PENILAIAN - Cara menguji penyimpanan nilai tes soal ke tabel `penilaian`

Dokumentasi singkat untuk menguji dan memverifikasi bahwa ketika peserta menyelesaikan _MCQ_ (tes soal), hasilnya tersimpan ke tabel `penilaian` pada kategori `tes_soal` dan kolom nilai kategori (`public_speaking`, `wawasan_genre`, `kepemimpinan`) berisi angka 0-100.

## Tujuan

- Verifikasi bahwa submit soal menyimpan satu baris pada tabel `penilaian` dengan `kategori = 'tes_soal'`.
- Pastikan kolom `public_speaking`, `wawasan_genre`, `kepemimpinan` berisi skor 0-100.

## File penting

- Controller peserta MCQ: `app/Http/Controllers/Peserta/UjianController.php`
    - Method `submit()` sekarang menghitung skor per kategori dan memanggil `Penilaian::create([...])`.
- Model penilaian: `app/Models/Penilaian.php` (tabel `penilaian`).
- Migration tabel penilaian: `database/migrations/2026_05_07_063025_create_penilaians_table.php`.

## Cara uji manual (PowerShell)

1. Jalankan server (jika belum):

```powershell
# dari folder proyek
php artisan serve --host=127.0.0.1 --port=8000
```

2. Login sebagai user peserta pada aplikasi (browser). Jika belum ada peserta test, buat user via tinker atau seeder, lalu pastikan `users.role = 'peserta'` dan ada row `peserta` yang terkait `user_id`.

3. Isi soal di UI dan submit. Setelah submit, pesan sukses akan muncul di dashboard peserta.

4. Cek hasil di DB menggunakan Tinker:

```powershell
php artisan tinker
>>> use Illuminate\Support\Facades\DB;
>>> DB::table('penilaian')->where('kategori', 'tes_soal')->orderBy('created_at', 'desc')->limit(5)->get();
```

Perhatikan record teratas. Field yang harus ada:

- peserta_id: id peserta yang mengerjakan
- kategori: 'tes_soal'
- public_speaking, wawasan_genre, kepemimpinan: integer 0..100
- juri_id: NULL (karena ini berasal dari tes otomatis)

Contoh query SQL (MySQL) untuk melihat satu entry terbaru:

```sql
SELECT * FROM penilaian WHERE peserta_id = <ID> AND kategori = 'tes_soal' ORDER BY created_at DESC LIMIT 1;
```

## Jika record tidak muncul

Langkah debugging cepat:

1. Pastikan user peserta memiliki relation `peserta` (cek tabel `peserta`) — controller akan abort bila `user->peserta` null.

2. Tambahkan logging di controller tepat sebelum `Penilaian::create()` untuk melihat nilai yang akan disimpan.

Buka `app/Http/Controllers/Peserta/UjianController.php` dan tambahkan sementara:

```php
\Log::debug('UjianController::submit payload', [
    'peserta_id' => $pesertaId,
    'scores' => $scores,
    'totals' => $totals,
    'corrects' => $corrects,
]);
```

Setelah men-submit, lihat `storage/logs/laravel.log` untuk pesan debug.

3. Cek migration dan struktur tabel `penilaian`:

```powershell
php artisan tinker
>>> DB::select("DESCRIBE penilaian");
```

Pastikan kolom `public_speaking`, `wawasan_genre`, `kepemimpinan` ada dan bertipe integer.

4. Periksa error di `storage/logs/laravel.log` setelah submit.

## Contoh payload untuk simulasi dengan Tinker

Jika ingin mensimulasikan submit tanpa UI, Anda bisa memanggil langsung method controller (lebih mudah: tes penulisan DB):

```php
php artisan tinker
>>> use App\Models\Penilaian;
>>> Penilaian::create([ 'peserta_id' => 1, 'juri_id' => null, 'kategori' => 'tes_soal', 'public_speaking' => 80, 'wawasan_genre' => 70, 'kepemimpinan' => 60 ]);
```

Jika perintah di atas berhasil maka tabel menerima data — berarti issue ada pada alur submit/validasi.

## Catatan teknis & checklist

- Pastikan tiap `soal` memiliki field `kategori` dengan salah satu nilai: `public_speaking`, `wawasan_genre`, `kepemimpinan`.
- Controller sekarang mengabaikan soal tanpa kategori yang valid.
- `juri_id` disimpan NULL untuk tes otomatis; migrasi sudah memperbolehkan `juri_id` nullable.
- Jika Anda ingin menyimpan nilai `nilai_tes` (agregat overall), kita bisa menambah kolom `nilai_tes` pada `penilaian` atau menyimpan di tabel terpisah.

## Next steps (opsional)

- Tambah log debug sementara di controller (saya bisa tambahkan jika mau).
- Tambah test feature (PHPUnit) yang mensubmit sample `answers` array dan assert record dibuat di DB.
- Buat halaman admin/peserta untuk melihat nilai `tes_soal` terbaru per peserta.

---

Jika mau, saya dapat menambahkan logging debug sekarang atau membuat test feature cepat. Pilih langkah yang Anda mau saya lakukan selanjutnya.
