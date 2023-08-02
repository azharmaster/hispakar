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

        Schema::table('medinvoice', function (Blueprint $table) {
            $table->float('subtotal')->nullable()->default(0.00)->after('medrecordid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medinvoice', function (Blueprint $table) {
            //
        });
    }
};
