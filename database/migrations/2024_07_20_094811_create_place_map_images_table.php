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
        Schema::create('place_map_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('imageId');
            $table->text('image')->nullable();
            $table->foreign('imageId')->references('id')->on('map_images')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('place_map_images');
    }
};
