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
            $table->id('publication_id')->primary();
            $table->string('publication_type');
            $table->string('publication_file');
            $table->string('publication_title');
            $table->string('publication_author');
            $table->date('publication_date');
            $table->string('publication_DOI');
            $table->string('username');
            $table->foreign('username')->references('username')->on('user')->onDelete('cascade');
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
