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
        Schema::create('fuzzyres', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Value1', 50)->nullable();
            $table->string('Value2', 50)->nullable();
            $table->string('Value3', 50)->nullable();
            $table->string('Date_created', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzzyres');
    }
};
