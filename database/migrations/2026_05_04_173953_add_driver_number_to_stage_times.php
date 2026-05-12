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
        Schema::table('stage_times', function (Blueprint $table) {
            $table->tinyInteger('driver_number')->default(1)->after('stage_id'); // 1 tai 2
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stage_times', function (Blueprint $table) {
            //
        });
    }
};
