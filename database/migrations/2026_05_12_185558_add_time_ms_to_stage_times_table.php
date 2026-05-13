<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stage_times', function (Blueprint $table) {
            $table->unsignedInteger('time_ms')->nullable()->after('time_result');
        });

        // Täytetään olemassaoleva data
        DB::statement("
            UPDATE stage_times
            SET time_ms = (
                CAST(SUBSTRING_INDEX(time_result, ':', 1) AS UNSIGNED) * 3600000 +
                CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(time_result, ':', 2), ':', -1) AS UNSIGNED) * 60000 +
                CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(time_result, ':', -1), '.', 1) AS UNSIGNED) * 1000 +
                CAST(SUBSTRING_INDEX(time_result, '.', -1) AS UNSIGNED)
            )
        ");
    }

    public function down(): void
    {
        Schema::table('stage_times', function (Blueprint $table) {
            $table->dropColumn('time_ms');
        });
    }
};