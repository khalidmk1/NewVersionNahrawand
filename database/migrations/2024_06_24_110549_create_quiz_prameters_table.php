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
        Schema::create('quiz_prameters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contentId')->nullable();
            $table->unsignedBigInteger('videoId')->nullable();
            $table->unsignedBigInteger('quizId')->nullable();
            $table->unsignedBigInteger('answerId');
            $table->text('rate')->nullable();
            $table->integer('count')->nullable();
            $table->softDeletes();
            $table->foreign('quizId')->references('id')->on('quizzes')->onDelete('cascade');
            $table->foreign('answerId')->references('id')->on('quiz_answers')->onDelete('cascade');
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
        Schema::dropIfExists('quiz_prameters');
    }
};
