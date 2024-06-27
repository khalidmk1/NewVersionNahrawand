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
        Schema::create('video_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('videoId');
            $table->unsignedBigInteger('userId');
            $table->longText('note')->nullable();
            $table->softDeletes();
            $table->foreign('userId')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('VideoId')->references('id')->on('content_videos')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_notes');
    }
};
