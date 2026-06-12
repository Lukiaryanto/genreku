<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('soal')->insert([
            [
                'pertanyaan' => 'Apa ibu kota Indonesia?',
                'opsi_a' => 'Medan',
                'opsi_b' => 'Jakarta',
                'opsi_c' => 'Bandung',
                'opsi_d' => 'Surabaya',
                'jawaban_benar' => 'b',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'pertanyaan' => 'Berapa hasil dari 7 x 6?',
                'opsi_a' => '42',
                'opsi_b' => '36',
                'opsi_c' => '48',
                'opsi_d' => '40',
                'jawaban_benar' => 'a',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'pertanyaan' => 'Manakah planet terdekat dengan Matahari?',
                'opsi_a' => 'Bumi',
                'opsi_b' => 'Venus',
                'opsi_c' => 'Merkurius',
                'opsi_d' => 'Mars',
                'jawaban_benar' => 'c',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
