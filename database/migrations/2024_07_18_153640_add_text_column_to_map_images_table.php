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
        Schema::table('map_images', function (Blueprint $table) {
            $table->text('title')->nullable()->after('type');
            $table->text('adresse')->nullable()->after('description');
            $table->text('link')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('map_images', function (Blueprint $table) {
            Schema::dropIfExists('title');
            Schema::dropIfExists('adresse');
            Schema::dropIfExists('link');
        });
    }
};
