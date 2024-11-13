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
        Schema::create('weather_caches', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('temp_c')->nullable();
            $table->string('feelslike_c')->nullable();
            $table->string('wind_kph')->nullable();
            $table->string('pressure_mb')->nullable();
            $table->string('humidity')->nullable();
            $table->string('precip_mm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_caches');
    }
};
