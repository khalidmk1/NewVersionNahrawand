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
        Schema::create('content_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contentId');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->text('video')->nullable();
            $table->boolean('isComing')->nullable()->default(false);
            $table->boolean('isUpdated')->nullable()->default(false);
            $table->boolean('isDelete')->nullable()->default(false);
            $table->time('duration')->nullable();
            $table->foreign('contentId')->references('id')->on('contents')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_videos');
    }
};
