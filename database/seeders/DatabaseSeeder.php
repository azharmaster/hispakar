<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

// command to run : php artisan db:seed

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    // Boleh je kalau nak clearkan table doctor, patient, nurse, attendance, appointment, medrecord, medpres, medinvoice, room
    public function run(): void
    {
        //new department / get dept id
        $primaryCare = DB::table('department')->where('name', 'Primary Care')->get();
        if ($primaryCare->isEmpty()) {
            // Insert "Primary Care" department if it doesn't exist
            $primaryCareId = DB::table('department')->insertGetId([
                'name' => 'Primary Care',
                'desc' => 'Department providing general medical services and routine healthcare.',
                'created_at' => now(),
                'updated_at' => NULL,
            ]);
        } else {
            // Retrieve the ID of the existing "Primary Care" department
            $primaryCareId = $primaryCare->first()->id;
        }

        $usersData = [
            [
                'email' => 'ahmad@gmail.com',
                'name' => 'ahmad',
                'password' => bcrypt('1234'),
                'usertype' => 1,
                'ic' => '660104110178',
            ],
            [
                'email' => 'dramin@gmail.com',
                'name' => 'amin',
                'password' => bcrypt('1234'),
                'usertype' => 2,
                'ic' => '870804030118',
            ],
            [
                'email' => 'aisyah@gmail.com',
                'name' => 'aisyah',
                'password' => bcrypt('1234'),
                'usertype' => 3,
                'ic' => '780507100645',
            ],
            [
                'email' => 'siti@gmail.com',
                'name' => 'siti',
                'password' => bcrypt('1234'),
                'usertype' => 4,
                'ic' => '000507110645',
            ],
        ];
        
        foreach ($usersData as $userData) {
            $email = $userData['email'];
            $user = DB::table('users')->where('email', $email)->first();
        
            if (!$user) {
                DB::table('users')->insert($userData);
            }
        }
        

        // Check if the user with email 'ahmad@gmail.com' exists
        $userAhmad = DB::table('admin')->where('email', 'ahmad@gmail.com')->first();
        if (!$userAhmad) {
            DB::table('admin')->insert([
            'name' => 'ahmad',
            'email' => 'ahmad@gmail.com',
            'password' => '1234',
            'phoneno' => '011198392898',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => NULL,
            ]);
        }

        // Check if the user with email 'dramin@gmail.com' exists
        $userAmin = DB::table('doctor')->where('email', 'dramin@gmail.com')->first();
        if (!$userAmin) {
            $docId = DB::table('doctor')->insertGetId([
                'name' => 'amin',
                'email' => 'dramin@gmail.com',
                'password' => '1234',
                'phoneno' => '01123456754',
                'deptid' => $primaryCareId,
                'education' => 'Respiratory Medicine PhD',
                'experience' => 'Handle 3 lung surgeries successfully',
                'roomid' => 1,
                'staff_id' => 'DR78982',
                'gender' => 'male',
                'ic' => '870804030118',
                'dob' => '1987-08-14',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => NULL,
            ]);

            $room = DB::table('room')->where('name', 'room78')->first();
            if (!$room) {
                DB::table('room')->insert([
                    'name' => 'room78',
                    'type' => 'office',
                    'desc' => 'doctor office',
                    'status' => 1,
                    'staff_id' => 'DR78982',
                    'created_at' => now(),
                    'updated_at' => NULL,
                ]);
            }

        }
        else{
            $docId = DB::table('doctor')->where('email', 'dramin@gmail.com')->value('id');
        }

        // Check if the nurse with email 'aisyah@gmail.com' exists
        $userAisyah = DB::table('nurse')->where('email', 'aisyah@gmail.com')->first();
        if (!$userAisyah) {
            $nurseId = DB::table('nurse')->insertGetId([
                'name' => 'aisyah',
                'email' => 'aisyah@gmail.com',
                'password' => '1234',
                'phoneno' => '011198322345',
                'deptid' => $primaryCareId,
                'gender' => 'female',
                'ic' => '780507100645',
                'dob' => '1978-05-07',
                'staff_id' => 'NR2377',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => NULL,
            ]);

            $room = DB::table('room')->where('name', 'room22')->first();
            if (!$room) {
                DB::table('room')->insert([
                'name' => 'room22',
                'type' => 'ward',
                'desc' => 'ward for patient',
                'status' => 1,
                'staff_id' => 'NR2377',
                'created_at' => now(),
                'updated_at' => NULL,
                ]);
            }

        }else{
            $nurseId = DB::table('nurse')->where('email', 'aisyah@gmail.com')->value('id');
        }

        // Check if the patient with email 'siti@gmail.com' exists
        $userSiti = DB::table('patient')->where('email', 'siti@gmail.com')->first();
        if (!$userSiti) {
            $patientId = DB::table('patient')->insertGetId([
                'name' => 'siti',
                'ic' => '000507110645',
                'email' => 'siti@gmail.com',
                'password' => '1234',
                'phoneno' => '01187777826',
                'address' => 'Shah Alam',
                'gender' => 'female',
                'height' => 156,
                'weight' => 45,
                'bloodtype' => 'O+',
                'dob' => '2000-05-07',
                'age' => 57,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => NULL,
            ]);
        }else{
            $patientId = DB::table('patient')->where('email', 'siti@gmail.com')->value('id');
        }

        // appointment / medrecord / 
        if ($patientId && $docId && $primaryCareId && $nurseId) {

            // first medical record
            $firstApt = DB::table('docschedule')->insert([ // for docschedule that day
                'docid' => $docId,
                'day' => 'Monday',
                'date' => '2023-08-01',
                'starttime' => '08:00:00',
                'endtime' => '17:00:00',
                'status' => NULL,
                'created_at' => '2023-07-20 09:44:13',
                'updated_at' => NULL,
            ]);

            if ($firstApt) {
                // Insert record into the "appointment" table
                $aptId = DB::table('appointment')->insertGetId([
                    'patientid' => $patientId,
                    'docid' => $docId,
                    'deptid' => $primaryCareId,
                    'date' => "2023-08-01",
                    'time' => "11:00:00",
                    'status' => 1,
                    'created_at' => '2023-07-21 10:44:13',
                    'updated_at' => NULL,
                ]);

                if ($aptId){

                    DB::table('attendance')->insert([
                        'aptid' => $aptId, 
                        'status' => 1, 
                        'reason' => NULL, 
                        'created_at' => '2023-08-01 11:09:31',
                        'updated_at' => NULL,
                    ]);

                    // Use the $aptId to insert a record into the "medrecord" table
                    $medrecordId = DB::table('medrecord')->insertGetId([
                        'aptid' => $aptId,
                        'serviceid' => 2,
                        'desc' => "The patient reports having a fever of 101°F (38.3°C). The fever started two days ago and has been progressively getting worse. The fever has been intermittent, and the patient has been taking over-the-counter medication (Paracetamol) to reduce it.",
                        'status' => 1, 
                        'img' => NULL,
                        'datetime' => "2023-08-01 11:09:31",
                        'docid' => $docId,
                        'patientid' => $patientId,
                        'refnum' => "002023989169",
                        'created_at' => '2023-08-01 11:30:31',
                        'updated_at' => NULL,
                    ]);

                    if ($medrecordId){
                        //medprecription
                        DB::table('medprescription')->insert([
                            'aptid' => $aptId, 
                            'name' => "Amoxicillin", 
                            'qty' => 2, 
                            'desc' => "Take 2 capsules every  8 hours as needed. Finish all dont skip.", 
                            'price' => 15.25,
                            'total' => 30.50,
                            'medicineid' =>  4,
                            'nurseid' => $nurseId,
                            'patientid' => $patientId, 
                            'docid' => $docId,
                            'created_at' => '2023-08-01 11:30:00',
                            'updated_at' => NULL,
                        ]);
                        DB::table('medprescription')->insert([
                            'aptid' => $aptId, 
                            'name' => "Paracetamol", 
                            'qty' => 2, 
                            'desc' => "Take 1 or 2 tablets (500mg) every 4-6 hours.", 
                            'price' => 10.50, 
                            'total' => 21.00,
                            'medicineid' =>  1,
                            'nurseid' => $nurseId,
                            'patientid' => $patientId,
                            'docid' => $docId, 
                            'created_at' => '2023-08-01 11:30:00',
                            'updated_at' => NULL,
                        ]);
                        //invoice
                        DB::table('medinvoice')->insert([
                            'medrecordid' => $medrecordId, 
                            'subtotal' => 101.50, 
                            'discount' => 0.00, 
                            'tax' => 0.00, 
                            'totalcost' => 101.50, 
                            'created_at' => '2023-08-01 11:30:00',
                            'updated_at' => NULL,
                        ]);
                    }
                }
            }//end

            // second medical record
            $secondApt = DB::table('docschedule')->insert([ // for docschedule that day
                'docid' => $docId,
                'day' => 'Saturday',
                'date' => '2023-08-06',
                'starttime' => '08:00:00',
                'endtime' => '17:00:00',
                'status' => NULL,
                'created_at' => '2023-07-20 09:44:13',
                'updated_at' => NULL,
            ]);

            if ($secondApt) {
                // Insert record into the "appointment" table
                $aptId2 = DB::table('appointment')->insertGetId([
                    'patientid' => $patientId,
                    'docid' => $docId,
                    'deptid' => $primaryCareId,
                    'date' => "2023-08-06",
                    'time' => "12:00:00",
                    'status' => 1,
                    'created_at' => '2023-08-04 10:44:13',
                    'updated_at' => NULL,
                ]);

                if ($aptId2){

                    DB::table('attendance')->insert([
                        'aptid' => $aptId2, 
                        'status' => 1, 
                        'reason' => NULL, 
                        'created_at' => '2023-08-06 12:09:31',
                        'updated_at' => NULL,
                    ]);

                    // Use the $aptId to insert a record into the "medrecord" table
                    $medrecordId2 = DB::table('medrecord')->insertGetId([
                        'aptid' => $aptId2,
                        'serviceid' => 4,
                        'desc' => "The result just okay, the patient need more rest and avoid heavy activities, the mc is given for 4 days. The patient must keep hydrated. I will schedule a follow-up appointment in 3 days.",
                        'status' => 1, 
                        'img' => NULL,
                        'datetime' => "2023-08-06 12:30:31",
                        'docid' => $docId,
                        'patientid' => $patientId,
                        'refnum' => "002023772356",
                        'created_at' => '2023-08-06 12:30:31',
                        'updated_at' => NULL,
                    ]);

                    if ($medrecordId2){
                        //medprecription
                        DB::table('medprescription')->insert([
                            'aptid' => $aptId2, 
                            'name' => "Amoxicillin", 
                            'qty' => 2, 
                            'desc' => "Take 2 tablets every 8 hours daily.", 
                            'price' => 15.25,
                            'total' => 30.50,
                            'medicineid' =>  4,
                            'nurseid' => $nurseId,
                            'patientid' => $patientId, 
                            'docid' => $docId,
                            'created_at' => '2023-08-06 12:30:31',
                            'updated_at' => NULL,
                        ]);
                        //invoice
                        DB::table('medinvoice')->insert([
                            'medrecordid' => $medrecordId2, 
                            'subtotal' => 110.50, 
                            'discount' => 0.00, 
                            'tax' => 0.00, 
                            'totalcost' => 110.50, 
                            'created_at' => '2023-08-06 12:30:31',
                            'updated_at' => NULL,
                        ]);
                    }
                }
            }//end

            //untuk appointment cancel
            $thirdApt = DB::table('docschedule')->insert([ // add docschedule for that day
                'docid' => $docId,
                'day' => 'Tuesday',
                'date' => '2023-08-08',
                'starttime' => '08:00:00',
                'endtime' => '17:00:00',
                'status' => NULL,
                'created_at' => '2023-07-20 09:44:13',
                'updated_at' => NULL,
            ]);

            if ($thirdApt) {
                $cancelAptId = DB::table('appointment')->insertGetId([
                    'patientid' => $patientId,
                    'docid' => $docId,
                    'deptid' => $primaryCareId,
                    'date' => "2023-08-08",
                    'time' => "09:00:00",
                    'status' => 2,
                    'created_at' => '2023-08-07 09:44:13',
                    'updated_at' => NULL,
                ]);
    
                DB::table('attendance')->insert([
                    'aptid' => $cancelAptId, 
                    'status' => 2, 
                    'reason' => NULL, 
                    'created_at' => '2023-08-08 09:30:00',
                    'updated_at' => NULL,
                ]);
            }//end
           
            // untuk new apointment
            $fourthApt = DB::table('docschedule')->insert([ // add docschedule for that day
                'docid' => $docId,
                'day' => now()->format('l'), // 'l' represents the full day name (e.g., "Monday")
                'date' => now()->toDateString(),
                'starttime' => '08:00:00',
                'endtime' => '17:00:00',
                'status' => NULL,
                'created_at' => now(),
                'updated_at' => NULL,
            ]);

            if ($fourthApt) {

                $newAptId = DB::table('appointment')->insertGetId([
                    'patientid' => $patientId,
                    'docid' => $docId,
                    'deptid' => $primaryCareId,
                    'date' => now()->toDateString(),
                    'time' => "17:30:00",
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => NULL,
                ]);
            }
        }
    }
}
