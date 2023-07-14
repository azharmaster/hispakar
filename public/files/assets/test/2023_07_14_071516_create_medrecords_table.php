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
        Schema::create('medrecord', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aptid')->nullable();
            $table->integer('serviceid')->nullable();
            $table->string('desc', 255)->nullable();
            $table->string('img', 255)->nullable();
            $table->datetime('datetime')->nullable();
            $table->integer('docid')->nullable();
            $table->integer('patientid')->nullable();
            $table->timestamps();
        });

        // Insert dummy data
        DB::table('medrecord')->insert([
            [
                'aptid' => 1,
                'serviceid' => 1,
                'desc' => 'The patient has chest pain',
                'img' => '',
                'datetime' => '2023-04-13 11:12:00',
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
