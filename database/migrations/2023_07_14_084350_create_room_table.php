<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop existing rooms table if it exists
        if (Schema::hasTable('rooms')) {
            Schema::drop('rooms');
        }

        Schema::create('room', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('desc', 255)->nullable();
            $table->integer('status')->comment('0: occupied, 1: available');
            $table->timestamps();
        });

        // Insert dummy data
        DB::table('room')->insert([
            [
                'name' => 'room78',
                'type' => 'office',
                'desc' => 'doctor room',
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
        Schema::dropIfExists('room');
    }
}
