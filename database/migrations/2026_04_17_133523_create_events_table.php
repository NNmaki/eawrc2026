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
        Schema::create('events', function (Blueprint $table) {
             $table->id();
            $table->foreignId('rally_id')->constrained('rallies')->onDelete('cascade');
            $table->string('player_name');
            $table->dateTime('start_time');
            $table->boolean('completed')->default(false);
            $table->time('total_time')->nullable();
            $table->timestamps();
            
            $table->index('rally_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
