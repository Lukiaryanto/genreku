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
            // Add unique constraint to ensure one-to-one relationship
            if (! Schema::hasColumn('peserta', 'user_id')) {
                return;
            }
            // Add unique index (assume migration hasn't been run yet). If the index
            // already exists this will error; that's why we check the column first.
            // Avoid using Doctrine calls for portability in this environment.
            $table->unique('user_id', 'peserta_user_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta', function (Blueprint $table) {
            $table->dropUnique('peserta_user_id_unique');
        });
    }
};
