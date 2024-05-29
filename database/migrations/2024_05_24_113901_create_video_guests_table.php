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
        Schema::create('video_guests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('VideoId');
            $table->unsignedBigInteger('userId');
            $table->boolean('isUpdated')->nullable()->default(false);
            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('VideoId')->references('id')->on('content_videos')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_guests');
    }
};
