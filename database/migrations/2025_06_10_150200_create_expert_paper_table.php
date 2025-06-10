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
        Schema::create('expert_paper', function (Blueprint $table) {
            $table->string('expertPaper_id')->primary();
            $table->string('paper_DOI');
            $table->string('paper_author');
            $table->date('paper_date');
            $table->string('expert_id');
            $table->foreign('expert_id')->references('expert_id')->on('expertDomain')->onDelete('cascade');
            $table->string('username');
            $table->foreign('username')->references('username')->on('profile')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expert_paper');
    }
};
