<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMedprescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop existing prescriptions table if it exists
        if (Schema::hasTable('prescriptions')) {
            Schema::drop('prescriptions');
        }

        // Drop existing prescription_records table if it exists
        if (Schema::hasTable('prescription_records')) {
            Schema::drop('prescription_records');
        }

        Schema::create('medprescription', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aptid')->nullable();
            $table->string('name', 255)->nullable();
            $table->integer('qty')->nullable();
            $table->string('desc', 255)->nullable();
            $table->float('price')->nullable();
            $table->integer('medicineid')->nullable();
            $table->integer('docid')->nullable();
            $table->integer('patientid')->nullable();
            $table->timestamps();
        });

        // Insert dummy data
        DB::table('medprescription')->insert([
            [
                'aptid' => 1,
                'name' => "aspirin",
                'qty' => 2,
                'desc' => "Eat after lunch, 2 times daily",
                'price' => 7.25,
                'medicineid' => 1,
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
        Schema::dropIfExists('medprescription');
    }
}
