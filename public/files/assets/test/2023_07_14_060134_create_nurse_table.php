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
        Schema::create('nurse', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('phoneno')->nullable();
            $table->integer('deptid')->nullable();
            $table->integer('status')->nullable()->comment('0: blacklist, 1: allow');
            $table->timestamps();
        });

        // Insert dummy data
        DB::table('nurse')->insert([
            'name' => 'aisyah',
            'email' => 'aisyah@gmail.com',
            'password' => '12345678',
            'phoneno' => '011198322345',
            'deptid' => 1,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nurse');
    }
};
