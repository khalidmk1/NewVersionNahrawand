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
        Schema::create('map_cities', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->decimal('lat', 10, 7); 
            $table->decimal('lng', 10, 7);
            $table->string('country');
            $table->string('iso2', 2);
            $table->string('admin_name')->nullable();
            $table->string('capital')->nullable();
            $table->integer('population')->nullable();
            $table->integer('population_proper')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_cities');
    }
};
