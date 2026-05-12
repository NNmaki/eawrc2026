<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('stage_times', function (Blueprint $table) {
        // Poista vanha constraint
        $table->dropUnique('stage_times_event_id_stage_id_unique');
        
        // Lisää uusi jossa on mukana driver_number
        $table->unique(['event_id', 'stage_id', 'driver_number']);
    });
}

public function down(): void
{
    Schema::table('stage_times', function (Blueprint $table) {
        $table->dropUnique(['event_id', 'stage_id', 'driver_number']);
        $table->unique(['event_id', 'stage_id']);
    });
}
};
