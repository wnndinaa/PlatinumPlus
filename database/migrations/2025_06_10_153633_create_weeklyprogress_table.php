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
        Schema::create('weeklyprogress', function (Blueprint $table) {
            $table->string('id');
            $table->string('username');
            $table->foreign('username')->references('username')->on('user')->onDelete('cascade');
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
