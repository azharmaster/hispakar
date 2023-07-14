<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMedrecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop existing appointments table if it exists
        if (Schema::hasTable('medrecord')) {
            Schema::drop('medrecord');
        }

        if (Schema::hasTable('treatments')) {
            Schema::drop('treatments');
        }

        if (Schema::hasTable('treatment_records')) {
            Schema::drop('treatment_records');
        }

        if (Schema::hasTable('payments')) {
            Schema::drop('payments');
        }

        if (Schema::hasTable('orders')) {
            Schema::drop('orders');
        }

        if (Schema::hasTable('services')) {
            Schema::drop('services');
        }

        Schema::create('medrecord', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aptid')->nullable();
            $table->integer('serviceid')->nullable();
            $table->string('desc', 255)->nullable();
            $table->string('img', 255)->nullable();
            $table->datetime('datetime')->nullable();
            $table->float('totalcost')->nullable();
            $table->integer('docid')->nullable();
            $table->integer('patientid')->nullable();
            $table->timestamps();
        });

        // Insert dummy data
        DB::table('medrecord')->insert([
            [
                'aptid' => 1,
                'serviceid' => 19,
                'desc' => 'The patient has chest pain',
                'img' => '',
                'datetime' => '2023-04-13 11:12:00',
                'totalcost' => '60.00',
                'docid' => 1,
                'patientid' => 1,
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
        Schema::dropIfExists('medrecord');
    }
}
