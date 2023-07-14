<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDocscheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Drop existing doctor_timings table if it exists
        if (Schema::hasTable('doctor_timings')) {
            Schema::drop('doctor_timings');
        }

        Schema::create('docschedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('docid')->unsigned();
            $table->string('day', 255);
            $table->date('date')->nullable();
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->integer('status')->nullable()->comment('0: booked, 1: available');
            $table->timestamps();
        });

        // Insert dummy data
        DB::table('docschedule')->insert([
            [
                'docid' => 1,
                'day' => 'Monday',
                'date' => '2023-07-15',
                'starttime' => '10:00:00',
                'endtime' => '11:00:00',
                'status' => 0,
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
        Schema::dropIfExists('docschedule');
    }
}
