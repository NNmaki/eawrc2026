<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('events', function (Blueprint $table) {
        $table->renameColumn('class', 'driver1_class');
        $table->renameColumn('car', 'driver1_car');
        $table->string('driver2_class')->nullable()->after('driver1_class');
        $table->string('driver2_car')->nullable()->after('driver1_car');
    });
}

public function down(): void
{
    Schema::table('events', function (Blueprint $table) {
        $table->renameColumn('driver1_class', 'class');
        $table->renameColumn('driver1_car', 'car');
        $table->dropColumn(['driver2_class', 'driver2_car']);
    });
}
};
