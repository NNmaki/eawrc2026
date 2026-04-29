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
        $table->string('time_result', 12)->change(); // "00:MM:SS.mmm"
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
