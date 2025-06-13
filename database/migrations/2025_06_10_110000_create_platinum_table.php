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
        Schema::create('platinum', function (Blueprint $table) {
            $table->string('username')->primary(); // FK to user's username
            $table->string('assignedCRMP');        // FK to CRMP's username

            $table->foreign('username')->references('username')->on('user')->onDelete('cascade');
            $table->foreign('assignedCRMP')->references('username')->on('user')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platinum');
    }
};
