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
        Schema::create('fuzzy_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('peserta_id')
                  ->constrained('peserta')
                  ->onDelete('cascade');

            $table->string('kategori');
            $table->string('komponen');

            $table->double('nilai_asli');

            $table->double('rendah');
            $table->double('sedang');
            $table->double('tinggi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzy_details');
    }
};