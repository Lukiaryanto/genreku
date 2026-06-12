<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fuzzy_configs', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // e.g. 'rendah_min', 'sedang_peak', 'tinggi_max'
            $table->string('label');         // Human-readable label untuk admin
            $table->float('value');          // Nilai range (0-100)
            $table->string('group')->default('membership'); // Grouping: membership / output
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fuzzy_configs');
    }
};
