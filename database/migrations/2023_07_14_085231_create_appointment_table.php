<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop existing appointments table if it exists
        if (Schema::hasTable('appointments')) {
            Schema::drop('appointments');
        }

        Schema::create('appointment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patientid')->unsigned();
            $table->integer('docid')->unsigned();
            $table->integer('deptid')->unsigned();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->integer('status')->nullable()->comment('0: cancel, 1: confirm');
            $table->timestamps();

            $table->foreign('patientid')->references('id')->on('patient');
            $table->foreign('docid')->references('id')->on('doctor');
            $table->foreign('deptid')->references('id')->on('department');
        });

        // Insert dummy data
        DB::table('appointment')->insert([
            [
                'patientid' => 1,
                'docid' => 1,
                'deptid' => 1,
                'date' => '2023-07-15',
                'time' => '10:00:00',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment');
    }
}
