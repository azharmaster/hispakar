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
        Schema::create('systeminfo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('shortname');
            $table->string('logo');
            $table->string('desc_system');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('systeminfo');
    }
};
