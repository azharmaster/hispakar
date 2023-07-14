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
        Schema::create('patient', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->string('ic', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('phoneno', 50)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('gender', 10)->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->string('bloodtype', 10)->nullable();
            $table->date('dob')->nullable();
            $table->integer('age')->nullable();
            $table->integer('status')->nullable()->comment('0: blacklist, 1: allow');
            $table->timestamps();
        });

        DB::table('patient')->insert([
            'name' => 'siti',
            'ic' => '660105110789',
            'email' => 'siti@gmail.com',
            'password' => '12345678',
            'phoneno' => '01187777826',
            'address' => 'Shah Alam',
            'gender' => 'Female',
            'height' => 156,
            'weight' => 45,
            'bloodtype' => 'O+',
            'dob' => '2023-03-12',
            'age' => 57,
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
        Schema::dropIfExists('patient');
    }
};
