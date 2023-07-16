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
        Schema::table('nurse', function (Blueprint $table) {
            $table->string('gender', 10)->nullable();
            $table->string('ic', 20)->nullable();
            $table->date('dob')->nullable();
            $table->string('staff_id', 15)->nullable();
            $table->boolean('usertype')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nurse', function (Blueprint $table) {
            //
        });
    }
};
