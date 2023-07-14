<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Drop existing medicines table if it exists
        if (Schema::hasTable('medicines')) {
            Schema::drop('medicines');
        }

        Schema::create('medicine', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->float('price')->nullable();
            $table->string('desc', 255)->nullable();
            $table->string('stock', 255)->nullable();
            $table->timestamps();
        });

        // Insert dummy data
        DB::table('medicine')->insert([
            [
                'name' => 'Paracetamol',
                'price' => 10.5,
                'desc' => 'Used for pain relief and reducing fever',
                'stock' => '100',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ibuprofen',
                'price' => 8.75,
                'desc' => 'Nonsteroidal anti-inflammatory drug (NSAID) used for pain relief and reducing inflammation',
                'stock' => '50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aspirin',
                'price' => 7.25,
                'desc' => 'Used for pain relief, reducing inflammation, and preventing blood clotting',
                'stock' => '80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amoxicillin',
                'price' => 15.25,
                'desc' => 'Antibiotic used to treat bacterial infections',
                'stock' => '75',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Omeprazole',
                'price' => 12.9,
                'desc' => 'Proton pump inhibitor (PPI) used to reduce stomach acid and treat conditions like acid reflux and ulcers',
                'stock' => '60',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Metformin',
                'price' => 18.75,
                'desc' => 'Oral medication used to treat type 2 diabetes',
                'stock' => '45',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Atorvastatin',
                'price' => 22.5,
                'desc' => 'Statin medication used to lower cholesterol levels',
                'stock' => '30',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Warfarin',
                'price' => 9.99,
                'desc' => 'Anticoagulant (blood thinner) used to prevent blood clots',
                'stock' => '55',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Salbutamol',
                'price' => 14.25,
                'desc' => 'Bronchodilator used to relieve asthma symptoms and other respiratory conditions',
                'stock' => '70',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Insulin',
                'price' => 32.8,
                'desc' => 'Medication used to control blood sugar levels in people with diabetes',
                'stock' => '25',
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
        Schema::dropIfExists('medicine');
    }
}
