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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clientId');
            $table->unsignedBigInteger('managerId')->nullable();
            $table->string('TypeTicket')->nullable();
            $table->boolean('status')->default(false);
            $table->longText('detail')->nullable();
            $table->longText('file')->nullable();
            $table->foreign('clientId')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('managerId')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
