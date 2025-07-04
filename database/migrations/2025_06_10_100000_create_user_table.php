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
        Schema::create('user', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('name');
            $table->string('ic');
            $table->string('email');
            $table->string('phonenumber');
            $table->string('role');
            $table->string('password');
            $table->string('gender');
            $table->string('citizenship');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
