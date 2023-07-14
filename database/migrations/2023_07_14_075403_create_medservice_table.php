<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateMedserviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medservice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 255);
            $table->string('desc', 255);
            $table->float('charge');
            $table->timestamps();
        });

        // Insert dummy data
        DB::table('medservice')->insert([
            [
                'type' => 'X-ray',
                'desc' => 'Diagnostic imaging technique that uses electromagnetic radiation to create detailed images of the inside of the body.',
                'charge' => 100.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Check-up',
                'desc' => 'Routine medical examination to assess a person\'s general health status.',
                'charge' => 50.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'MRI (Magnetic Resonance Imaging)',
                'desc' => 'Medical imaging technique that uses magnetic fields and radio waves to generate detailed images of the body.',
                'charge' => 200.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Blood testing',
                'desc' => 'Laboratory analysis of blood samples to evaluate various health conditions and parameters.',
                'charge' => 80.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Ultrasound',
                'desc' => 'Medical imaging technique that uses sound waves to create images of the internal organs and tissues.',
                'charge' => 120.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'CT scan (Computed Tomography)',
                'desc' => 'Diagnostic imaging technique that uses X-rays and computer processing to create cross-sectional images of the body.',
                'charge' => 150.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'ECG (Electrocardiogram)',
                'desc' => 'Recording of the electrical activity of the heart to assess heart health and diagnose heart conditions.',
                'charge' => 70.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Physical therapy',
                'desc' => 'Rehabilitation treatment that aims to restore movement, function, and relieve pain through exercises and manual techniques.',
                'charge' => 90.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Surgery',
                'desc' => 'Medical procedure that involves incisions and manipulation of body tissues to treat or repair a specific condition.',
                'charge' => 500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Vaccinations',
                'desc' => 'Administration of vaccines to prevent various diseases and protect against infections.',
                'charge' => 40.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Laboratory services',
                'desc' => 'Diagnostic testing and analysis of biological samples, such as blood, urine, or tissues, to aid in the diagnosis and monitoring of diseases.',
                'charge' => 60.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Pharmacy services',
                'desc' => 'Dispensing and management of medications to patients as prescribed by healthcare professionals.',
                'charge' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Emergency care',
                'desc' => 'Immediate medical attention and treatment for severe injuries, illnesses, or life-threatening conditions.',
                'charge' => 200.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Maternity and childbirth services',
                'desc' => 'Prenatal care, labor and delivery assistance, and postnatal care for expectant mothers and newborns.',
                'charge' => 300.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Cardiac catheterization',
                'desc' => 'Diagnostic and treatment procedure that involves threading a catheter through blood vessels to diagnose and treat heart conditions.',
                'charge' => 400.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Endoscopy',
                'desc' => 'Medical procedure that uses a flexible tube with a light and camera to visualize and examine the internal organs or cavities.',
                'charge' => 250.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Dialysis',
                'desc' => 'Treatment for individuals with impaired kidney function that involves filtering waste and excess fluid from the blood.',
                'charge' => 180.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Oncology (Cancer treatment)',
                'desc' => 'Medical specialty focused on the diagnosis and treatment of cancer, including chemotherapy, radiation therapy, and surgical interventions.',
                'charge' => 1000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Respiratory therapy',
                'desc' => 'Treatment and management of respiratory conditions and disorders, such as asthma, chronic obstructive pulmonary disease (COPD), and sleep apnea.',
                'charge' => 80.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Occupational therapy',
                'desc' => 'Therapeutic interventions to help individuals regain independence and improve daily living skills after injury, illness, or disability.',
                'charge' => 90.00,
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
        Schema::dropIfExists('medservice');
    }
}