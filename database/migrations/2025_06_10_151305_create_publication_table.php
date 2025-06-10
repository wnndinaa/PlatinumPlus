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
        Schema::create('publication', function (Blueprint $table) {
            $table->string('publication_id')->primary();
            $table->string('publication_type');
            $table->string('publication_file');
            $table->integer('publication_number');
            $table->string('publication_tittle');
            $table->string('publication_author');
            $table->date('publication_date');
            $table->string('publication_DOI');
            $table->string('username');
            $table->foreign('username')->references('username')->on('profile')->onDelete('cascade');
            $table->foreignId('expertPaper_id');
            $table->foreign('expertPaper_id')->references('expertPaper_id')->on('expert_paper')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication');
    }
};
