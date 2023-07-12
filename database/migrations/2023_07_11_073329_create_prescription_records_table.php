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
        Schema::create('prescription_records', function (Blueprint $table) {
            $table->id()->startingValue(1);
            $table->integer('prescription_id')->nullable();
            $table->string('medicine_name', 255)->nullable();
            $table->float('cost', 10, 2)->nullable();
            $table->integer('unit')->nullable();
            $table->string('dosage', 255)->nullable();
            $table->string('status', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_records');
    }
};
