<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn('docid');
            $table->dropColumn('patientid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('attendance', function (Blueprint $table) {
            // If you want to rollback the migration, you can add the columns back here
            $table->integer('docid');
            $table->integer('patientid');
        });
    }
};
