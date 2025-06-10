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
        Schema::create('expert_domain', function (Blueprint $table) {
            $table->string('expert_id')->primary();
            $table->string('expert_name');
            $table->string('expert_university');
            $table->string('expert_occupation');
            $table->string('expert_phoneNum');
            $table->string('expert_email');
            $table->string(column: 'domain_expertise');
            $table->foreignId('profiles_username');
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expert_domain');
    }
};
