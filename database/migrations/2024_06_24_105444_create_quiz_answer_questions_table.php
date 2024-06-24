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
        Schema::create('quiz_answer_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contentId');
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('quizId');
            $table->longText('answer')->nullable();
            $table->softDeletes();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contentId')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('quizId')->references('id')->on('quizzes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_answer_questions');
    }
};
