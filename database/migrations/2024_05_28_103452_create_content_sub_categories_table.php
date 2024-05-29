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
        Schema::create('content_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contentId');
            $table->unsignedBigInteger('subCategoryId')->nullable();
            $table->foreign('contentId')->references('id')->on('contents')->cascadeOnDelete();
            $table->foreign('subCategoryId')->references('id')->on('sub_categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_sub_categories');
    }
};
