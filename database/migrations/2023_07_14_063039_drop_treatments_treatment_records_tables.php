<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropTreatmentsTreatmentRecordsPaymentsOrdersServicesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('treatments');
        Schema::dropIfExists('treatment_records');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('services');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Since you are dropping the tables, you don't need to define the "down" method.
        // However, if you want to recreate the tables in a rollback, you can define the "down" method accordingly.
    }
}
