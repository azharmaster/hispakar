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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->startingValue(1);
            $table->integer('patientid')->nullable();
            $table->integer('doctorid')->nullable();
            $table->integer('prescriptionid')->nullable();
            $table->date('orderdate')->nullable();
            $table->date('deliverydate')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('mobileno', 50)->nullable();
            $table->string('note', 255)->nullable();
            $table->string('status', 100)->nullable();
            $table->string('payment_type', 20)->nullable();
            $table->string('card_no', 20)->nullable();
            $table->string('cvv_no', 5)->nullable();
            $table->date('expdate')->nullable();
            $table->string('card_holder', 50)->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
