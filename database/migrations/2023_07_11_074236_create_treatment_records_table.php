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
        Schema::create('treatment_records', function (Blueprint $table) {
            $table->id()->startingValue(1);
            $table->integer('treatmentid')->nullable();
            $table->integer('appointmentid')->nullable();
            $table->integer('patientid')->nullable();
            $table->integer('doctorid')->nullable();
            $table->string('treatment_description', 255)->nullable();
            $table->string('uploads', 255)->nullable();
            $table->date('treatment_date')->nullable();
            $table->time('treatment_time')->nullable();
            $table->string('status', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatment_records');
    }
};
