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
        // Drop existing doctors table if it exists
        if (Schema::hasTable('doctors')) {
            Schema::drop('doctors');
        }

        Schema::create('doctor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('phoneno', 50)->nullable();
            $table->integer('deptid')->nullable();
            $table->string('education', 255)->nullable();
            $table->string('experience', 255)->nullable();
            $table->integer('status')->nullable()->comment('0: blacklist, 1: allow');
            $table->timestamps();
        });

        DB::table('doctor')->insert([
            'name' => 'asyraf',
            'email' => 'drasyraf@gmail.com',
            'password' => bcrypt('12345678'),
            'phoneno' => '01123456754',
            'deptid' => 1,
            'education' => 'Respiratory Medicine PhD',
            'experience' => 'Handle 3 of lung surgeries successfully',
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
        Schema::dropIfExists('doctor');
    }
};
