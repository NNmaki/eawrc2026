<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     
// database/migrations/xxxx_add_driver_fields_to_events_table.php
public function up(): void
{
    Schema::table('events', function (Blueprint $table) {
        $table->string('driver_name');
        $table->string('class');   // WRC, WRC2, JUNIOR WRC
        $table->string('car');
    });
}

public function down(): void
{
    Schema::table('events', function (Blueprint $table) {
        $table->dropColumn(['driver_name', 'class', 'car']);
    });
}

};
