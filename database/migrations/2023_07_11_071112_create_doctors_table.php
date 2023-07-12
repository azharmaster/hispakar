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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id()->startingValue(1);
            $table->string('doctorname', 255)->nullable();
            $table->string('mobileno', 255)->nullable();
            $table->integer('departmentid')->nullable();
            $table->string('loginid', 25);
            $table->string('password', 25);
            $table->string('status', 255)->nullable();
            $table->string('education', 255)->nullable();
            $table->string('experience', 255)->nullable();
            $table->string('consultancy_charge', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
