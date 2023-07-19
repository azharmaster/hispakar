<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //dummy data
        DB::table('users')->insert([
            [
                'name' => 'ahmad',
                'email' => 'ahmad@gmail.com',
                'password' => '$2y$10$LFUCdZ0cpEZ8PyD2xkbyrO7z25cE32DlJ4K4EoaSe5N/M38hgAA0G', // Hashed password
                'usertype' => 1,
                'ic' => 1,
            ],
            [
                'name' => 'asyraf',
                'email' => 'drasyraf@gmail.com',
                'password' => '$2y$10$LFUCdZ0cpEZ8PyD2xkbyrO7z25cE32DlJ4K4EoaSe5N/M38hgAA0G', // Hashed password
                'usertype' => 2,
                'ic' => 1,
            ],
            [
                'name' => 'aisyah',
                'email' => 'aisyah@gmail.com',
                'password' => '$2y$10$LFUCdZ0cpEZ8PyD2xkbyrO7z25cE32DlJ4K4EoaSe5N/M38hgAA0G', // Hashed password
                'usertype' => 3,
                'ic' => 1,
            ],
            [
                'name' => 'siti',
                'email' => 'siti@gmail.com',
                'password' => '$2y$10$LFUCdZ0cpEZ8PyD2xkbyrO7z25cE32DlJ4K4EoaSe5N/M38hgAA0G', // Hashed password
                'usertype' => 4,
                'ic' => 1,
            ],
        ]);
    }
}
