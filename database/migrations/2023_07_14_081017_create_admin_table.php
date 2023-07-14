<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop existing admin table if it exists
        if (Schema::hasTable('admin')) {
            Schema::drop('admin');
        }

        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('phoneno')->nullable();
            $table->integer('status')->nullable()->comment('0: blacklist, 1: allow');
            $table->timestamps();
        });

        // Insert dummy data
        DB::table('admin')->insert([
            'name' => 'ahmad',
            'email' => 'ahmad@gmail.com',
            'password' => '12345678',
            'phoneno' => '011198392898',
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
        Schema::dropIfExists('admin');
    }
};