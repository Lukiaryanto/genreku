# PENILAIAN - Overview & integration notes (for Sugeno fuzzy)

This document summarizes everything related to the `Penilaian` model in this project and gives practical guidance for integrating a Sugeno fuzzy algorithm for final scoring/decision.

> Location: `app/Models/Penilaian.php`
> Table: `penilaian`

## 1) Current schema

Migration file: `database/migrations/2026_05_07_063025_create_penilaians_table.php`

Columns (important):

- `id` (PK)
- `peserta_id` (FK -> `peserta.id`, cascade on delete)
- `juri_id` (FK -> `juri.id`, nullable; ON DELETE SET NULL)
- `kategori` (enum: `tes_soal`, `wawancara`, `project`)
- `public_speaking` (unsignedSmallInteger, default 0)
- `wawasan_genre` (unsignedSmallInteger, default 0)
- `kepemimpinan` (unsignedSmallInteger, default 0)
- `created_at`, `updated_at`

Indexes:

- `kategori` indexed
- composite index on (`peserta_id`, `juri_id`)

Notes:

- `kategori` is used to separate different assessment sources: automatic MCQ (`tes_soal`), human interview (`wawancara`) and human project evaluation (`project`).
- MCQ submissions are stored with `juri_id = NULL` and `kategori = 'tes_soal'` (implemented in `UjianController::submit`).

## 2) Models & controllers

- Model: `app/Models/Penilaian.php` with `$fillable` = [peserta_id, juri_id, kategori, public_speaking, wawasan_genre, kepemimpinan]

# PENILAIAN - Ringkasan & panduan integrasi (untuk Sugeno fuzzy)

Dokumen ini merangkum semua hal penting terkait model `Penilaian` di proyek ini dan memberikan panduan praktis untuk mengintegrasikan algoritma fuzzy Sugeno untuk penghitungan skor akhir atau pengambilan keputusan.

Lokasi: `app/Models/Penilaian.php`

Tabel: `penilaian`

## 1) Skema saat ini

File migrasi: `database/migrations/2026_05_07_063025_create_penilaians_table.php`

Kolom penting:

- `id` (PK)
- `peserta_id` (FK -> `peserta.id`, cascade on delete)
- `juri_id` (FK -> `juri.id`, nullable; ON DELETE SET NULL)
- `kategori` (enum: `tes_soal`, `wawancara`, `project`)
- `public_speaking` (unsignedSmallInteger, default 0)
- `wawasan_genre` (unsignedSmallInteger, default 0)
- `kepemimpinan` (unsignedSmallInteger, default 0)
- `created_at`, `updated_at`

Index:

- `kategori` di-index
- index komposit pada (`peserta_id`, `juri_id`)

Catatan:

- Kolom `kategori` digunakan untuk membedakan sumber penilaian: MCQ otomatis (`tes_soal`), wawancara manusia (`wawancara`), dan penilaian project (`project`).
- Submit MCQ disimpan dengan `juri_id = NULL` dan `kategori = 'tes_soal'` (diimplementasikan pada `UjianController::submit`).

## 2) Model & controller terkait

- Model: `app/Models/Penilaian.php` (fillable: `peserta_id, juri_id, kategori, public_speaking, wawasan_genre, kepemimpinan`)
- Endpoint/controller yang membuat `Penilaian`:
    - `App\Http\Controllers\Peserta\UjianController::submit()` — membuat `Penilaian` dengan `kategori = 'tes_soal'` dan skor dihitung per kategori.
    - `App\Http\Controllers\PenilaianController::store()` — digunakan juri untuk menyimpan nilai `wawancara` dan `project`. Method `storeProject()` mendelegasikan ke `store()`.

Route utama:

- POST `/penilaian` -> `PenilaianController@store` (dipakai form juri)
- POST `/juri/project` -> `PenilaianController@storeProject` (mendelegasikan ke store dan menetapkan `kategori=project`)

## 3) Alur data singkat

1. MCQ (peserta): peserta mengirim jawaban -> `UjianController::submit()` menghitung skor per kategori (public_speaking, wawasan_genre, kepemimpinan) dan menyimpan satu baris `penilaian` dengan `kategori = 'tes_soal'` dan `juri_id = NULL`.
2. Wawancara / Project (juri): juri mengisi form -> `PenilaianController::store()` memvalidasi dan membuat baris `penilaian` dengan `juri_id = <juri.id>` dan `kategori` sesuai.

## 4) Contoh query SQL cepat

- Ambil `tes_soal` terbaru untuk peserta dengan id = 5:

```sql
SELECT * FROM penilaian WHERE peserta_id = 5 AND kategori = 'tes_soal' ORDER BY created_at DESC LIMIT 1;
```

- Rata-rata `public_speaking` pada penilaian kategori project:

```sql
SELECT AVG(public_speaking) FROM penilaian WHERE kategori = 'project';
```

- Ambil record terbaru per kategori untuk setiap peserta (MySQL 8+):

```sql
SELECT * FROM (
  SELECT *, ROW_NUMBER() OVER (PARTITION BY peserta_id, kategori ORDER BY created_at DESC) rn
  FROM penilaian
) t WHERE rn = 1;
```

## 5) Integrasi Sugeno fuzzy — ringkasan

Tujuan: Gunakan skor per-kategori (0-100) untuk menghasilkan skor akhir lewat sistem Sugeno (nilai keluaran numerik), lalu pakai skor itu untuk ranking atau pengambilan keputusan (mis. lulus/tidak-lulus).

Gagasan penggunaan:

- Gabungkan beberapa baris `penilaian` per peserta (mis. `tes_soal` terbaru, rata-rata `wawancara`, `project` terbaru) menjadi satu vektor input untuk Sugeno.
- Keluaran Sugeno bisa berupa:
    - Skor akhir numerik (0-100) untuk peringkat; atau
    - Keputusan diskrit (mis. `lulus`) setelah threshold.

Langkah desain singkat:

1. Pilih input. Contoh vektor input:
    - x1 = MCQ_public_speaking (0..100)
    - x2 = MCQ_wawasan_genre (0..100)
    - x3 = MCQ_kepemimpinan (0..100)
    - x4 = Interview_avg_score (0..100)
    - x5 = Project_score (0..100)

2. Normalisasi input ke 0..1 jika ingin menyederhanakan definisi fungsi keanggotaan.

3. Definisikan fungsi keanggotaan (Triangular/Trapezoidal) untuk setiap variabel input (Low, Medium, High).

4. Definisikan aturan Sugeno; contoh:
    - IF x1 is High AND x4 is High THEN output = 0.6*x1 + 0.4*x4
    - IF x3 is Low AND x5 is Low THEN output = 0.2*x1 + 0.3*x3 + 0.5\*x5

5. Implementasi: tulis engine Sugeno di PHP atau panggil layanan eksternal (Python/Node).

## 6) Pilihan implementasi

A. Murni PHP

- Implementasikan evaluator Sugeno kecil sendiri:
    - Hitung derajat keanggotaan untuk setiap antecedent.
    - Hitung bobot aturan (mis. `min` untuk AND).
    - Hitung keluaran per aturan (konstanta atau fungsi linear dari input).
    - Final = weighted average: sum(w_i \* y_i) / sum(w_i).

Contoh stub (pseudo-PHP) ada di dokumen asli — bisa saya implementasikan.

B. Hybrid (microservice Python/JS)

- Implementasi di Python (lebih cepat untuk eksperimen) lalu panggil via HTTP dari PHP.

## 7) Pipeline contoh untuk menghitung skor Sugeno per peserta

1. Query input (ambil `penilaian` terbaru/aggregate per kategori untuk peserta).
2. Susun vektor input.
3. Jalankan engine Sugeno (PHP/local service).
4. Simpan skor akhir di tabel baru `final_scores` atau di kolom `peserta.final_score` beserta metadata.

Skema tabel `final_scores` (rekomendasi migrasi):

- `id`, `peserta_id`, `value` (decimal), `method` (string, e.g. 'sugeno_v1'), `metadata` (json), `created_at`

## 8) Query batch (Artisan command)

- Buat Artisan command `compute:final-scores`:
    - Ambil inputs per peserta, panggil Sugeno evaluator, tulis `final_scores`.

## 9) Catatan mutu data

- Pastikan denominasi tidak nol saat aggregasi (mis. bila tidak ada soal kategori tertentu).
- Tentukan kebijakan missing input (isi 0, rata-rata, atau abaikan) agar inference konsisten.

## 10) Langkah berikut yang bisa saya bantu implementasikan

- Buatkan Artisan command `compute:final-scores` yang menghitung Sugeno untuk semua peserta dan menyimpan ke `final_scores`.
- Implementasikan evaluator Sugeno sederhana di PHP lengkap dengan unit tests.
- Tambahkan migrasi & model `FinalScore` dan hubungkan ke UI admin.

Jika kamu mau, saya bisa mulai mengerjakan salah satu: buat evaluator PHP, buat migrasi `final_scores` + model + command, atau buat microservice Sugeno di Python. Pilih yang mau saya kerjakan.
