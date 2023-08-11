<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// command to run : php artisan db:seed --class=ClearTablesSeeder

class ClearTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // clearkan semua data dalam table ni
        $tablesToClear = [
            'users',
            'admin',
            'doctor',
            'nurse',
            'patient',
            'medrecord',
            'medinvoice',
            'medprescription',
            'appointment',
            'attendance',
            'docschedule',
            'room',
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Disable foreign key checks

        foreach ($tablesToClear as $table) {
            DB::table($table)->truncate(); // Clear table without dropping it
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Enable foreign key checks
    }
}
