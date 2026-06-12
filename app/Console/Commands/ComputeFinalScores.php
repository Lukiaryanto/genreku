<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Peserta;
use App\Models\Penilaian;
use App\Services\SugenoService;

class ComputeFinalScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'compute:final-scores {kategori?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compute Sugeno Fuzzy final scores for participants';

    /**
     * Execute the console command.
     */
    public function handle(SugenoService $sugenoService)
    {
        $kategoriInput = $this->argument('kategori');
        $kategoris = $kategoriInput ? [$kategoriInput] : ['tes_soal', 'wawancara', 'project'];

        $pesertas = Peserta::all();
        $this->info("Found " . $pesertas->count() . " participants.");

        foreach ($kategoris as $kategori) {
            $this->info("Processing kategori: {$kategori}");
            $count = 0;

            foreach ($pesertas as $peserta) {
                // Cek apakah ada penilaian
                $hasPenilaian = Penilaian::where('peserta_id', $peserta->id)
                    ->where('kategori', $kategori)
                    ->exists();

                if ($hasPenilaian) {
                    try {
                        $sugenoService->processPeserta($peserta->id, $kategori);
                        $count++;
                    } catch (\Exception $e) {
                        $this->error("Failed to process peserta {$peserta->id} for {$kategori}: " . $e->getMessage());
                    }
                }
            }
            
            $this->info("Finished processing {$count} participants for {$kategori}.");
        }

        $this->info("All done!");
    }
}
