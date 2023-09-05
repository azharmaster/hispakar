<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class apttimes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data from the table
        DB::table('apttime')->truncate();

        // Seed the table with sample data
        DB::table('apttime')->insert([
            [
                'time' => '8.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '8.30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '9.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '9.30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '10.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '10.30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '11.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '11.30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '12.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '12.30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '14.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '14.30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '15.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '15.30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '16.00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '16.30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more sample posts here if needed
        ]);
    }
}
