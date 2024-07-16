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
        Schema::create('map_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mapId');
            $table->text('type')->nullable();
            $table->longText('image')->nullable();
            $table->text('description')->nullable();
            $table->foreign('mapId')->references('id')->on('maps')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_images');
    }
};
