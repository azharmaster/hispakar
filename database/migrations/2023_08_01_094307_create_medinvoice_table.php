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
        Schema::create('medinvoice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medrecordid');
            $table->float('discount')->nullable();
            $table->float('tax')->nullable();
            $table->float('totalcost')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medinvoice');
    }
};
