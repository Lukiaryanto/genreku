 <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('penilaian', function (Blueprint $table) {
                $table->id();

                // Foreign keys (reference singular table names used across project)
                $table->foreignId('peserta_id')
                    ->constrained('peserta')
                    ->cascadeOnDelete();

                $table->foreignId('juri_id')
                    ->constrained('juri')
                    ->cascadeOnDelete();

                // Kategori penilaian
                $table->enum('kategori', [
                    'tes_soal',
                    'wawancara',
                    'project',
                ])->index();

                // Score columns: small unsigned integers (0-65535) are sufficient
                $table->unsignedSmallInteger('public_speaking')->default(0);
                $table->unsignedSmallInteger('wawasan_genre')->default(0);
                $table->unsignedSmallInteger('kepemimpinan')->default(0);

                $table->timestamps();

                // Indexes for faster lookups
                $table->index(['peserta_id', 'juri_id']);
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('penilaian');
        }
    };
