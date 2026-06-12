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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();

            // foreign keys
            $table->foreignId('peserta_id')->constrained('peserta')->onDelete('cascade');
            $table->foreignId('juri_id')->nullable()->constrained('juri')->onDelete('cascade');

            // scores
            $table->decimal('nilai_tes', 5, 2)->nullable();
            $table->decimal('nilai_public_speaking', 5, 2)->nullable();
            $table->decimal('nilai_modul', 5, 2)->nullable();
            $table->decimal('nilai_wawasan', 5, 2)->nullable();

            // created_at (and updated_at kept for convenience)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
