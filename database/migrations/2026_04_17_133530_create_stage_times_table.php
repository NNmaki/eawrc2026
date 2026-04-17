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
        Schema::create('stage_times', function (Blueprint $table) {
           $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('stage_id')->constrained('stages')->onDelete('cascade');
            $table->time('time_result'); // Tallennetaan muodossa HH:MM:SS tai tarkemmin
            $table->dateTime('recorded_at');
            $table->timestamps();
            
            // Indeksit nopeampaan hakuun
            $table->index('event_id');
            $table->index('stage_id');
            
            // Varmistetaan, että samalle eventille ei voi kirjata samaa stagea kahdesti
            $table->unique(['event_id', 'stage_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stage_times');
    }
};
