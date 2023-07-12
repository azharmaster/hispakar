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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id()->startingValue(1);
            $table->string('appointmenttype', 255)->nullable();
            $table->integer('patientid')->nullable();
            $table->integer('roomid')->nullable();
            $table->integer('departmentid')->nullable();
            $table->date('appointmentdate')->nullable();
            $table->time('appointmenttime')->nullable();
            $table->integer('doctorid')->nullable();
            $table->string('status', 255)->nullable();
            $table->string('app_reason', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
