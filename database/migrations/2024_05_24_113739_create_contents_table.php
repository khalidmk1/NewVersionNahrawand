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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categoryId');
            $table->unsignedBigInteger('hostId');
            $table->unsignedBigInteger('programId')->nullable();
            $table->text('image')->nullable();
            $table->text('imageFlex')->nullable();
            $table->text('video')->nullable();
            $table->string('title')->nullable();
            $table->text('bigDescription')->nullable();
            $table->text('smallDescription')->nullable();
            $table->string('contentType')->nullable();
            $table->string('quizType')->nullable(); 
            $table->boolean('isActive')->nullable()->default(true);
            $table->boolean('isComing')->nullable()->default(false);
            $table->boolean('isCertify')->nullable()->default(false);
            $table->boolean('pricing')->nullable()->default(false);
            $table->boolean('isUpdated')->nullable()->default(false);
            $table->boolean('isDelete')->nullable()->default(false);
            $table->text('document')->nullable();
            $table->text('condition')->nullable();
            $table->time('duration')->nullable();
            $table->foreign('hostId')->references('id')->on('users');
            $table->foreign('categoryId')->references('id')->on('categories');
            $table->foreign('programId')->references('id')->on('programs');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
