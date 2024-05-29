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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->string('firstName');
            $table->string('lastName');
            $table->boolean('isLogin')->default(false);
            $table->boolean('isPopular')->default(false);
            $table->boolean('password_change')->default(false);
            $table->boolean('isUpdated')->nullable()->default(false);
            $table->boolean('isDelete')->nullable()->default(false);
            $table->text('biographie')->nullable();
            $table->string('faceboock')->nullable();
            $table->string('linkdin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('datebirt')->nullable();
            $table->string('status_matrimonial')->nullable();
            $table->integer('numChild')->nullable();
            $table->string('profission')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
