<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop existing departments table if it exists
        if (Schema::hasTable('departments')) {
            Schema::drop('departments');
        }

        Schema::create('department', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('desc', 255)->nullable();
            $table->timestamps();
        });

        // Insert dummy data
        DB::table('department')->insert([
            [
                'name' => 'Cardiology',
                'desc' => 'Department specialized in the diagnosis and treatment of heart diseases.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dermatology',
                'desc' => 'Department focused on the diagnosis and treatment of skin conditions.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Endocrinology',
                'desc' => 'Department specialized in the diagnosis and treatment of hormonal disorders.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gastroenterology',
                'desc' => 'Department specialized in the diagnosis and treatment of digestive system disorders.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hematology',
                'desc' => 'Department focused on the diagnosis and treatment of blood-related disorders.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Infectious Diseases',
                'desc' => 'Department specialized in the diagnosis and treatment of infectious diseases.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more departments and their descriptions
            [
                'name' => 'Nephrology',
                'desc' => 'Department specialized in the diagnosis and treatment of kidney diseases.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Neurology',
                'desc' => 'Department focused on the diagnosis and treatment of neurological disorders.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Obstetrics and Gynecology',
                'desc' => 'Department specialized in women\'s reproductive health and childbirth.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Oncology',
                'desc' => 'Department specialized in the diagnosis and treatment of cancer.',
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
        Schema::dropIfExists('department');
    }
}
