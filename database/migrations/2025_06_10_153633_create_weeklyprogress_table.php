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
        Schema::create('weeklyprogresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profiles_username');
            $table->date('startDate');
            $table->date('endDate');
            $table->string('progressinfo');
            $table->string('feedback');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weeklyprogresses');
    }
};
