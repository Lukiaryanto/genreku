<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations. 
     */
    public function up(): void
    {
        // Some MySQL setups require dropping the FK before altering the column.
        // Attempt to drop FK if exists, then alter column to nullable and recreate FK with ON DELETE SET NULL.
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // drop foreign key if it exists (name may vary)
        try {
            DB::statement('ALTER TABLE `penilaian` DROP FOREIGN KEY `penilaian_juri_id_foreign`');
        } catch (\Exception $e) {
            // ignore if not exists
        }

        // Alter column to allow NULL
        DB::statement('ALTER TABLE `penilaian` MODIFY `juri_id` BIGINT UNSIGNED NULL');

        // Add FK with ON DELETE SET NULL
        try {
            DB::statement('ALTER TABLE `penilaian` ADD CONSTRAINT `penilaian_juri_id_foreign` FOREIGN KEY (`juri_id`) REFERENCES `juri`(`id`) ON DELETE SET NULL');
        } catch (\Exception $e) {
            // ignore
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        try {
            DB::statement('ALTER TABLE `penilaian` DROP FOREIGN KEY `penilaian_juri_id_foreign`');
        } catch (\Exception $e) {
        }

        // Make juri_id NOT NULL again (if you prefer a different default, update here)
        DB::statement('ALTER TABLE `penilaian` MODIFY `juri_id` BIGINT UNSIGNED NOT NULL');

        // Recreate FK with CASCADE (original behavior)
        try {
            DB::statement('ALTER TABLE `penilaian` ADD CONSTRAINT `penilaian_juri_id_foreign` FOREIGN KEY (`juri_id`) REFERENCES `juri`(`id`) ON DELETE CASCADE');
        } catch (\Exception $e) {
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};
