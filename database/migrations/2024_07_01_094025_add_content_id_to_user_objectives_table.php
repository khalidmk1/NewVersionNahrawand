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
        Schema::table('user_objectives', function (Blueprint $table) {
            $table->unsignedBigInteger('contentId')->after('userId');
            $table->foreign('contentId')->references('id')->on('contents')->onDelete('cascade'); // Add the foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_objectives', function (Blueprint $table) {
            $table->dropForeign(['contentId']);
            $table->dropColumn('contentId');
        });
    }
};
