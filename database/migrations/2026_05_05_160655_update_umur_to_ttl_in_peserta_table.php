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
        Schema::table('peserta', function (Blueprint $table) {
            $table->dropColumn('umur');
            $table->date('tanggal_lahir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta', function (Blueprint $table) {
            // add umur back as date and drop tanggal_lahir
            if (! Schema::hasColumn('peserta', 'umur')) {
                $table->date('umur')->nullable();
            }

            if (Schema::hasColumn('peserta', 'tanggal_lahir')) {
                $table->dropColumn('tanggal_lahir');
            }
        });
    }
};
