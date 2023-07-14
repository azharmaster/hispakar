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
        Schema::dropIfExists('patients');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            // Define the table structure if needed
        });
    }
};
