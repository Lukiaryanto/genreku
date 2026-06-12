<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Attempt to drop the unique index on pimpinans.email if it exists
        try {
            DB::statement('ALTER TABLE `pimpinans` DROP INDEX `pimpinans_email_unique`');
        } catch (\Exception $e) {
            // ignore if index does not exist or other errors
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate unique index (no-op if it already exists)
        try {
            DB::statement('CREATE UNIQUE INDEX `pimpinans_email_unique` ON `pimpinans` (`email`)');
        } catch (\Exception $e) {
            // ignore
        }
    }
};
