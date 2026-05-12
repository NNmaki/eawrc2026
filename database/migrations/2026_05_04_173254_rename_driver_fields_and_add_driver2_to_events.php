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
        Schema::table('events', function (Blueprint $table) {
        
        $table->renameColumn('driver_name', 'driver1_name');
        $table->string('driver2_name')->nullable()->after('driver1_name');
        $table->string('total_time_driver2', 12)->nullable()->after('total_time');




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            
        $table->renameColumn('driver1_name', 'driver_name');
        $table->dropColumn(['driver2_name', 'total_time_driver2']);



        });
    }
};
