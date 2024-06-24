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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contentId')->nullable();
            $table->unsignedBigInteger('videoId')->nullable();
            $table->text('question')->nullable();
            $table->softDeletes();
            $table->foreign('contentId')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('videoId')->references('id')->on('content_videos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
