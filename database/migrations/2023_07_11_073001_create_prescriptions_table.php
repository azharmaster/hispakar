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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id()->startingValue(1);
            $table->integer('treatment_records_id')->nullable();
            $table->integer('doctorid')->nullable();
            $table->integer('patientid')->nullable();
            $table->string('delivery_type', 10)->nullable();
            $table->integer('delivery_id')->nullable();
            $table->date('prescriptiondate')->nullable();
            $table->string('status', 100)->nullable();
            $table->integer('appointmentid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
