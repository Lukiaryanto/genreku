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
        if (! Schema::hasTable('juri')) {
            Schema::create('juri', function (Blueprint $table) {
                $table->id();
                // reference to users table
                $table->foreignId('user_id')->constrained()->onDelete('cascade');

                // juri details
                $table->string('nama');
                $table->string('keahlian')->nullable();

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juri');
    }
};
