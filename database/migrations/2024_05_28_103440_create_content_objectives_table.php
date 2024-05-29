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
        Schema::create('content_objectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contentId');
            $table->unsignedBigInteger('objectivelId')->nullable();
            $table->foreign('contentId')->references('id')->on('contents')->cascadeOnDelete();
            $table->foreign('objectivelId')->references('id')->on('objectives')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_objectives');
    }
};
