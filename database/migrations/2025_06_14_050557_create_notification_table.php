<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notification', function (Blueprint $table) {
            $table->string('notification_id')->primary();
            $table->string('from_username');
            $table->string('to_username');
            $table->string('expertPaper_id');
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('from_username')->references('username')->on('user')->onDelete('cascade');
            $table->foreign('to_username')->references('username')->on('user')->onDelete('cascade');
            $table->foreign('expertPaper_id')->references('expertPaper_id')->on('expert_paper')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
