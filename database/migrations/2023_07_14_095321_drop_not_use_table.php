<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropNotUsefulTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('treatments')) {
            Schema::dropIfExists('treatments');
        }

        if (Schema::hasTable('treatment_records')) {
            Schema::dropIfExists('treatment_records');
        }

        if (Schema::hasTable('payments')) {
            Schema::dropIfExists('payments');
        }

        if (Schema::hasTable('orders')) {
            Schema::dropIfExists('orders');
        }

        if (Schema::hasTable('services')) {
            Schema::dropIfExists('services');
        }
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
