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
        Schema::dropIfExists('pesertas');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Jika diperlukan, Anda bisa membuat ulang tabel di sini.
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->integer('umur');
            $table->text('alamat')->nullable();
            $table->string('asal_instansi')->nullable();
            $table->string('status_seleksi')->default('pending');
            $table->timestamps();
        });
    }
};
