<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('draftthesis', function (Blueprint $table) {
            $table->string('id');
            $table->string('username');
            $table->string('thesislink');
            $table->integer('number');
            $table->date('startDate');
            $table->date('enddate');
            $table->integer('totalpage');
            $table->integer('prepdays');
            $table->string('feedback');
            $table->foreign('username')->references('username')->on('profile')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('draftthesis');
    }
};
