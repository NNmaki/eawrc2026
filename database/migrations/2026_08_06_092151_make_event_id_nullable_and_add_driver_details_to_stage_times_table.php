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
            $table->dropForeign(['event_id']);
        });

        Schema::table('stage_times', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->nullable()->change();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('set null');

            $table->string('driver_name', 3)->nullable()->after('driver_number');
            $table->string('class')->nullable()->after('driver_name');
            $table->string('car')->nullable()->after('class');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stage_times', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropColumn(['driver_name', 'class', 'car']);
        });

        Schema::table('stage_times', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->change();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }
};
