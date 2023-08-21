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
            // Adding 'status' column
            $table->integer('status')->nullable()->default(1)->after('medrecordid')->comment('0: Pending 1: Paid');
            
            // Adding 'method' column
            $table->string('method', 255)->nullable()->default('Cash')->after('totalcost');

            // Adding 'datetime' column
            $table->datetime('datetime')->nullable()->default(now())->after('method');
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
