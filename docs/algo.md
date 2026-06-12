# IMPLEMENTASI METODE FUZZY SUGENO ORDE NOL
# SISTEM PENILAIAN DUTA GENRE

---

# 1. Gambaran Sistem

Sistem penilaian Duta GenRe menerapkan metode Fuzzy Sugeno Orde Nol untuk menghasilkan evaluasi kompetensi peserta secara transparan dan objektif.

Metode diterapkan secara terpisah pada setiap kategori penilaian:

- Tes Soal
- Wawancara
- Project

Setiap kategori memiliki 3 komponen penilaian:

- Public Speaking
- Wawasan GenRe
- Kepemimpinan

Sistem tidak menghasilkan satu nilai akhir global, melainkan menghasilkan kompetensi pada masing-masing kategori seleksi.

---

# 2. Tujuan Sistem

Tujuan implementasi sistem:

- membantu dewan juri melakukan penilaian,
- menghasilkan evaluasi kompetensi secara objektif,
- menampilkan detail hasil fuzzy,
- memberikan transparansi proses penilaian,
- menampilkan persentase keanggotaan fuzzy pada setiap komponen.

---

# 3. Struktur Penilaian

## Kategori Penilaian

| Kategori |
|---|
| Tes Soal |
| Wawancara |
| Project |

---

## Komponen Penilaian

| Komponen |
|---|
| Public Speaking |
| Wawasan GenRe |
| Kepemimpinan |

---

# 4. Variabel Input

## Input 1
Public Speaking

## Input 2
Wawasan GenRe

## Input 3
Kepemimpinan

---

# 5. Variabel Output

## Variabel Output
Potensi Kompetensi

---

## Konstanta Sugeno Orde Nol

| Status | Nilai Konstanta |
|---|---|
| Kurang Kompeten | 0.4 |
| Cukup Kompeten | 0.6 |
| Sangat Kompeten | 0.8 |

---

# 6. Himpunan Fuzzy

Setiap variabel input memiliki 3 himpunan fuzzy:

- Rendah
- Sedang
- Tinggi

---

# 7. Membership Function

## Rendah

Range:
0 – 50

---

## Sedang

Range:
40 – 80

---

## Tinggi

Range:
75 – 100

---

# 8. Rumus Membership Function

## Fungsi Naik

μ(x) = (x - a) / (b - a)

---

## Fungsi Turun

μ(x) = (b - x) / (b - a)

---

# 9. Contoh Fuzzifikasi

## Input Nilai

| Komponen | Nilai |
|---|---|
| Public Speaking | 70 |
| Wawasan GenRe | 85 |
| Kepemimpinan | 65 |

---

# 10. Hasil Membership

## Public Speaking = 70

| Himpunan | Nilai Membership |
|---|---|
| Rendah | 0 |
| Sedang | 0.5 |
| Tinggi | 0 |

---

## Wawasan GenRe = 85

| Himpunan | Nilai Membership |
|---|---|
| Rendah | 0 |
| Sedang | 0 |
| Tinggi | 0.4 |

---

## Kepemimpinan = 65

| Himpunan | Nilai Membership |
|---|---|
| Rendah | 0 |
| Sedang | 0.75 |
| Tinggi | 0 |

---

# 11. Persentase Membership

## Public Speaking

| Rendah | Sedang | Tinggi |
|---|---|---|
| 0% | 100% | 0% |

---

## Wawasan GenRe

| Rendah | Sedang | Tinggi |
|---|---|---|
| 0% | 0% | 100% |

---

## Kepemimpinan

| Rendah | Sedang | Tinggi |
|---|---|---|
| 0% | 100% | 0% |

---

# 12. Rule Fuzzy Sugeno

Jumlah rule:

3 variabel × 3 himpunan

3³ = 27 rule

| No | Public Speaking | Wawasan Genre | Kepemimpinan | Potensi | Nilai z |
|---|---|---|---|---|---|
| R1 | Rendah | Rendah | Rendah | Kurang Kompeten | 0,4 |
| R2 | Rendah | Rendah | Sedang | Kurang Kompeten | 0,4 |
| R3 | Rendah | Rendah | Tinggi | Cukup Kompeten | 0,6 |
| R4 | Rendah | Sedang | Rendah | Kurang Kompeten | 0,4 |
| R5 | Rendah | Sedang | Sedang | Cukup Kompeten | 0,6 |
| R6 | Rendah | Sedang | Tinggi | Cukup Kompeten | 0,6 |
| R7 | Rendah | Tinggi | Rendah | Cukup Kompeten | 0,6 |
| R8 | Rendah | Tinggi | Sedang | Cukup Kompeten | 0,6 |
| R9 | Rendah | Tinggi | Tinggi | Sangat Kompeten | 0,8 |
| R10 | Sedang | Rendah | Rendah | Kurang Kompeten | 0,4 |
| R11 | Sedang | Rendah | Sedang | Cukup Kompeten | 0,6 |
| R12 | Sedang | Rendah | Tinggi | Cukup Kompeten | 0,6 |
| R13 | Sedang | Sedang | Rendah | Cukup Kompeten | 0,6 |
| R14 | Sedang | Sedang | Sedang | Cukup Kompeten | 0,6 |
| R15 | Sedang | Sedang | Tinggi | Sangat Kompeten | 0,8 |
| R16 | Sedang | Tinggi | Rendah | Cukup Kompeten | 0,6 |
| R17 | Sedang | Tinggi | Sedang | Sangat Kompeten | 0,8 |
| R18 | Sedang | Tinggi | Tinggi | Sangat Kompeten | 0,8 |
| R19 | Tinggi | Rendah | Rendah | Cukup Kompeten | 0,6 |
| R20 | Tinggi | Rendah | Sedang | Cukup Kompeten | 0,6 |
| R21 | Tinggi | Rendah | Tinggi | Sangat Kompeten | 0,8 |
| R22 | Tinggi | Sedang | Rendah | Cukup Kompeten | 0,6 |
| R23 | Tinggi | Sedang | Sedang | Sangat Kompeten | 0,8 |
| R24 | Tinggi | Sedang | Tinggi | Sangat Kompeten | 0,8 |
| R25 | Tinggi | Tinggi | Rendah | Sangat Kompeten | 0,8 |
| R26 | Tinggi | Tinggi | Sedang | Sangat Kompeten | 0,8 |
| R27 | Tinggi | Tinggi | Tinggi | Sangat Kompeten | 0,8 |


# 14. Firing Strength

Operator yang digunakan:

MIN

---

## Rumus

α = min(μ1, μ2, μ3)

---

# 15. Defuzzifikasi Sugeno

Metode yang digunakan:

Weighted Average

---

## Rumus Defuzzifikasi

z = Σ(αi × zi) / Σ αi

Keterangan:

- αi = firing strength
- zi = output rule

---

# 16. Contoh Perhitungan Sugeno

## Data Rule

| Rule | α-predicate | Output |
|---|---|---|
| R17 | 0.4 | 0.8 |
 

---

## Perhitungan

z = (0.4 × 0.8)/0.4 =0.8

---

## Hasil

z = 0.8

---

# 17. Interpretasi Hasil

| Range | Status |
|---|---|
| 0 – 0.40 | Kurang Kompeten |
| 0.41 – 0.60 | Cukup Kompeten |
| 0.61 – 0.80 | Sangat Kompeten |

---

# 18. Contoh Output Sistem

## TES SOAL

### Public Speaking

| Rendah | Sedang | Tinggi |
|---|---|---|
| 0% | 100% | 0% |

---

### Wawasan GenRe

| Rendah | Sedang | Tinggi |
|---|---|---|
| 0% |0% |100% |

---

### Kepemimpinan

| Rendah | Sedang | Tinggi |
|---|---|---|
| 0% | 100% | 0% |

---

## HASIL SUGENO

| Nilai Sugeno | Status |
|---|---|
| 0.8 | Sangat Kompeten |

---

# 19. Transparansi Sistem

Sistem tidak hanya menghasilkan status kompetensi, tetapi juga menampilkan:

- nilai membership fuzzy,
- persentase rendah,
- persentase sedang,
- persentase tinggi,
- hasil Sugeno.

Hal ini membuat proses penilaian lebih transparan dan mudah dipahami oleh dewan juri.

---

# 20. Struktur Database

## Tabel penilaian

Menyimpan nilai mentah peserta.

| Field |
|---|
| peserta_id |
| kategori |
| public_speaking |
| wawasan_genre |
| kepemimpinan |

---

## Tabel fuzzy_detail

Menyimpan hasil membership fuzzy.

| Field |
|---|
| peserta_id |
| kategori |
| komponen |
| rendah |
| sedang |
| tinggi |

---

## Tabel hasil_fuzzy

Menyimpan hasil Sugeno.

| Field |
|---|
| peserta_id |
| kategori |
| nilai_hasil |
| status |

---

# 21. Relasi Sistem

```text
Peserta
   │
   ├── Penilaian
   │
   ├── FuzzyDetail
   │
   └── HasilFuzzy