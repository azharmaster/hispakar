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
        Schema::create('patients', function (Blueprint $table) {
            $table->id()->startingValue(1);
            //nama,ic,noreg,address,notel,email,
            $table->string('name', 255)->nullable();
            $table->string('ic', 255)->nullable();
            $table->string('noreg', 255)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('notel', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('bloodtype', 10)->nullable();
            $table->string('dob', 255)->nullable();
            $table->string('gender', 10)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
