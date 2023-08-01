<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Appointments;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\DocSchedule;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\MedPrescription;
use App\Models\MedRecord;
use App\Models\MedService;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\Room;
use App\Models\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
    public function index()
    {
        $email=Auth()->user()->email;
        $name=Auth()->user()->name;

        $doctor = Doctor::where('email', Auth::user()->email)->first();

        $doctorId = $doctor->id;

        $drRoom = Room::join('doctor', 'room.staff_id', '=', 'doctor.staff_id')
                ->select('room.name')
                ->where('doctor.id', $doctorId)
                ->first();

        if ($drRoom) {
            $roomName = $drRoom->name; // Extract just the room name from the object
        }

        // Get the current date in the 'Y-m-d' format
        $currentDate = Carbon::now('Asia/Kuala_Lumpur')->toDateString();

        //total appointment card
        // $totalApt = Appointments::join('doctor', 'appointment.docid', '=', 'doctor.id')
        // ->select('appointment.*')
        // ->where('doctor.email', $email)
        // ->count();

        $totalApt = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
                    ->join('doctor', 'appointment.docid', '=', 'doctor.id')
                    ->select('appointment.*', 'patient.*')
                    ->where('doctor.id', $doctorId)
                    ->whereDate('appointment.date', $currentDate) 
                    ->count();

        // Get the most recent appointment's created_at timestamp
        $latestAppointment = Appointments::orderBy('created_at', 'desc')->first();

        // Calculate the time difference between now and the appointment's created_at timestamp
        $timeDifference = $latestAppointment ? Carbon::parse($latestAppointment->created_at)->diffForHumans() : 'N/A';

        //total patient card
        // $totalPatient = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        // ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        // ->select('appointment.*')
        // ->count();

        $totalPatient = Patient::all()->count();

        // Get the most recent patient's created_at timestamp
        $latestPatient = Patient::orderBy('created_at', 'desc')->first();

        // Calculate the time difference between now and the patient's created_at timestamp
        $timePDifference = $latestPatient ? Carbon::parse($latestPatient->created_at)->diffForHumans() : 'N/A';
  
        //total nurse card
        $totalNurse = Nurse::join('doctor', 'nurse.deptid', '=', 'doctor.deptid')
                    ->select('nurse.*')
                    ->count();

        // Get the most recent nurse's created_at timestamp
        $latestNurse = Nurse::orderBy('created_at', 'desc')->first();

        // Calculate the time difference between now and the nurse's created_at timestamp
        $timeNDifference = $latestNurse ? Carbon::parse($latestNurse->created_at)->diffForHumans() : 'N/A';
  
        // Get the current date in the 'Y-m-d' format
        $currentDate = Carbon::now('Asia/Kuala_Lumpur')->toDateString();

        $aptDs = Appointments::leftJoin('attendance', 'appointment.id', '=', 'attendance.aptid')
        ->join('patient', 'appointment.patientid', '=', 'patient.id')
        ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        ->select('appointment.id as appointment_id', 'patient.id as patient_id', 'appointment.*', 'patient.*', 'attendance.status')
        ->where('doctor.id', $doctorId)
        ->whereDate('appointment.date', $currentDate) 
        ->orderBy('appointment.time', 'asc')
        ->take(5)
        ->get();
   

    
        //get list of appointment
        // $aptList = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        //             ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        //             ->select('appointment.*', 'patient.*')
        //             ->where('doctor.id', $doctorId)
        //             ->whereDate('appointment.date', $currentDate) 
        //             ->orderBy('appointment.time', 'asc')
        //             ->take(5)
        //             ->all

        //medicine list card
        $medicines = Medicine::all();

        //approval & cancellation graph
        // Get the current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $totalattend = [];
        // Loop through the past five months and get the attendance data
        for ($i = 4; $i >= 0; $i--) {
            $month = ($currentMonth - $i) % 12;
            $year = $currentYear;
            if ($month === 0) {
                // If the calculated month is 0 (December), set it to 12 and adjust the year
                $month = 12;
                $year--;
            }
            
            // Get the start and end dates of the current month
            $startDate = "$year-$month-01";
            $endDate = date('Y-m-t', strtotime($startDate));

            $totalattend[] = Appointments::whereMonth('date', $month)
                ->whereYear('date', $year)
                ->where('status', 1)
                ->where('docid', $doctor->id)
                ->count();

            $totalcancel[] = Appointments::whereMonth('date', $month)
                ->whereYear('date', $year)
                ->where('status', 3)
                ->where('docid', $doctor->id)
                ->count();
        }

        //patient by gender
        $totalmale = Patient::join('medrecord', 'patient.id', '=', 'medrecord.patientid')
                    ->where('patient.gender', 'male')
                    ->where('medrecord.docid', $doctor->id)
                    ->count();

        $totalfemale = Patient::join('medrecord', 'patient.id', '=', 'medrecord.patientid')
                    ->where('patient.gender', 'female')
                    ->where('medrecord.docid', $doctor->id)
                    ->count();
        
        //Age
        $children = Patient::join('appointment', 'patient.id', '=', 'appointment.patientid')
        ->where('patient.age', '<=', 12)
        ->where('appointment.docid', $doctor->id)
        ->select('patient.id') // Select only the patient IDs
        ->distinct()
        ->count(); // Age up to 12 years

        $teenage = Patient::join('appointment', 'patient.id', '=', 'appointment.patientid')
        ->whereBetween('age', [13, 19])
        ->where('appointment.docid', $doctor->id)
        ->select('patient.id') // Select only the patient IDs
        ->distinct()
        ->count(); // Age between 13 and 19 years

        $adult = Patient::join('appointment', 'patient.id', '=', 'appointment.patientid')
        ->whereBetween('age', [20, 64])
        ->where('appointment.docid', $doctor->id)
        ->select('patient.id') // Select only the patient IDs
        ->distinct()
        ->count(); // Age between 20 and 64 years

        $older = Patient::join('appointment', 'patient.id', '=', 'appointment.patientid')
        ->where('age', '>=', 65)
        ->where('appointment.docid', $doctor->id)
        ->select('patient.id') // Select only the patient IDs
        ->distinct()
        ->count(); // Age 65 years and above


        //calendar
        // Initialize an empty array to store the transformed events
        $calendarEvents = [];

        // Fetch appointment data
        $appointments = DB::table('appointment')
        ->select('date', DB::raw('COUNT(*) as appointment_count'))
        ->groupBy('date')
        ->where('docid', $doctorId)
        ->get();

        foreach ($appointments as $appointment) {
        $appointmentDate = $appointment->date;
        $appointmentCount = $appointment->appointment_count;

            $calendarEvents[] = [
                'title' => $appointmentCount . ' - Appointment',
                'start' => $appointmentDate,
                'url' => url('doctor/appointmentList?date=' . $appointmentDate . '&sort=asc'),
                'backgroundColor' => '#FF9F32',
                'borderColor' => '#FF9F32',
                'allDay' => true,
            ];
        }

        return view('doctor.contents.dashboard', compact(
        //doctor name & room
        'name', 'roomName', 
        // total apt & time
        'totalApt', 'timeDifference', 
        //total patient & time
        'timePDifference', 'totalPatient', 
        //total nurse & time
        'timeNDifference', 'totalNurse', 
        //total apts & current date
        'aptDs', 'currentDate', 
        //medicines
        'medicines',
        //graph total attend & cancel
        'totalattend', 'totalcancel', 
        //graph patient by gender
        'totalmale', 'totalfemale',
        //age
        'children', 'teenage', 'adult', 'older',
        //calendar
        'calendarEvents'
        ));
    }

    public function viewSchedule()
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Find the Doctor model associated with the logged-in user
        $doctor = Doctor::where('email', $user->email)->first();

        if (!$doctor) {
            // Handle the case if the logged-in user is not a doctor
            // For example, redirect them to a different page or show an error message
            // You can also return an empty array of schedules if you prefer
        }

        // Get the schedules associated with the found doctor
        $schedules = DocSchedule::where('docid', $doctor->id)->get();

         // Pass the doctor ID to the view
        $doctorId = $doctor->id;

        // Get the current day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
        $currentDay = Carbon::now('Asia/Kuala_Lumpur')->dayOfWeek;

        // Pass the schedules and doctorId to the view
        return view('doctor.contents.scheduleList', compact('schedules', 'doctorId', 'currentDay'));
    }

    public function viewProfile()
    {
        // Get the currently authenticated user
        $user = auth()->user();

        $departments = Department::all();

        if ($user->usertype === 2) {
            // Get the doctor's name from the 'nurse' table based on the email
            $doctor = Doctor::where('email', $user->email)->first();

            $department = Department::find($doctor->deptid);

            return view('doctor.contents.profile', [
                'id' => $doctor->id,
                'name' => $doctor->name,
                'ic' => $doctor->ic,
                'email' => $doctor->email,
                'phoneno' => $doctor->phoneno,
                'education' => $doctor->education,
                'experience' => $doctor->experience,
                'gender' => $doctor->gender,
                'dob' => $doctor->dob,
                'profilepic' => $doctor->profilepic,
                'deptid' => $doctor->deptid,
                'department' => $department,
            ])->with('departments', $departments);
        }
    }

    public function viewPatientList()
    {
        $patients = Patient::all();

        return view('doctor.contents.patientList', compact('patients'));
    }

    public function viewAppointmentList(Request $request)
    {
        // Get the currently logged-in doctor
        $doctor = Doctor::where('email', Auth::user()->email)->first();
    
        if (!$doctor) {
            // Handle the case if the logged-in user is not a doctor
            // For example, redirect them to a different page or show an error message
            // You can also return an empty array of appointments if you prefer
        }
    
         // Get the current date
        $currentDate = Carbon::now('Asia/Kuala_Lumpur')->toDateString();

        // Get the doctor's schedule for the current week
        $startOfWeek = Carbon::now('Asia/Kuala_Lumpur')->startOfWeek();
        $endOfWeek = Carbon::now('Asia/Kuala_Lumpur')->endOfWeek();

        $doctorSchedule = DocSchedule::where('docid', $doctor->id)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->pluck('date')
            ->toArray();

        // Get the selected date from the request, or set it to the first available date if not provided
        $selectedDate = $request->input('date', reset($doctorSchedule));

        // Set the fixed time slots from 8:00 AM to 5:00 PM with 30-minute intervals
        $start = Carbon::parse('8:00 AM');
        $end = Carbon::parse('5:00 PM');
        $timeSlots = [];
        
        while ($start < $end) {
            $timeSlots[] = $start->format('g:i A') . ' - ' . $start->addMinutes(30)->format('g:i A');
        }

        // To join tables and retrieve the appointment list based on the doctor's ID
        $appointments = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
            ->join('doctor', 'appointment.docid', '=', 'doctor.id')
            ->join('department', 'appointment.deptid', '=', 'department.id')
            ->select('appointment.*', 'patient.name as patient_name', 'doctor.name as doctor_name', 'department.name as dept_name')
            ->where('appointment.status', 1)
            ->where('doctor.id', $doctor->id)
            ->where('appointment.deptid', $doctor->deptid)
            ->where('appointment.date', $currentDate)
            ->get();
    
        $patients = Patient::all();
        $doctors = Doctor::all();
        $departments = Department::all();
    

        return view('doctor.contents.appointmentList', compact('appointments', 'patients', 'doctors', 'departments', 
            'doctor', 'doctorSchedule', 'timeSlots', 'selectedDate'));
    }

    public function getDoctorSchedule($doctorId)
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $doctorSchedule = DocSchedule::where('docid', $doctorId)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get();

        return response()->json($doctorSchedule);
    }
    
    public function viewAppointmentReport($id)
    {
        $appointment = Appointments::with(['patient', 'medrecord'])
            ->where('id', $id)
            ->first();


            if (!$appointment->patient || !$appointment->medrecord) {
                $appointment = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
                    ->join('medrecord', 'appointment.id', '=', 'medrecord.aptid')
                    ->select('appointment.*', 'patient.*', 'medrecord.*')
                    ->where('appointment.id', $id)
                    ->first();
            }

        $singlePatient = $appointment->patient;
        $medservices = MedService::all();
        $patients = Patient::all(); // Add this line to fetch all patients

        $medicines = Medicine::all();
        $medNum = 1; // Initialize the $medNum variable to 1

        return view('doctor.contents.appointmentReport', compact('appointment', 'medicines', 'singlePatient', 'medservices', 'patients', 'medNum'));
    }

    public function viewMedicineList()
    {
        $medicines = Medicine::all();

        return view('doctor.contents.medicines', compact('medicines'));
    }

    public function viewReportList()
    {
        $filteredReports = MedRecord::join('patient', 'medrecord.patientid', '=', 'patient.id')
                        ->join('medservice', 'medrecord.serviceid', '=', 'medservice.id')
                        ->select('medrecord.*', 'patient.name as patient_name', 'medservice.type as service_type', 'medrecord.datetime')
                        ->with('medservice') // Eager load the medservice relationship
                        ->get();
                        
        return view('doctor.contents.reports', compact('filteredReports'));
    }   



    // Manage Schedule
    public function AddSchedule(Request $request)
    {
        $schedule = new DocSchedule();

        $schedule->docid = $request->docid;
        $schedule->day = $request->day;
        $schedule->date = $request->date;
        $schedule->starttime = $request->starttime;
        $schedule->endtime = $request->endtime;
        $schedule->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $schedule->save();

        return redirect('/doctor/scheduleList')->with('success', 'New schedule has been successfully added');

    }

    public function EditSchedule(Request $request, $id)
    {
        $schedule = DocSchedule::find($id);

        $schedule->docid = $request->input('docid');
        $schedule->day = $request->input('day');
        $schedule->date = $request->input('date');
        $schedule->starttime = $request->input('starttime');
        $schedule->endtime = $request->input('endtime');
        $schedule->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $schedule->save();

        return redirect('/doctor/scheduleList')->with('success', 'Schedule has been updated');

    }

    public function DeleteSchedule($id)
    {
        $schedule = DocSchedule::findOrFail($id);

        $schedule->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE docschedule SET id = @counter:=@counter+1;');


        return redirect('/doctor/scheduleList')->with('success', 'Schedule has been deleted');
    }


    //Edit Profile
    public function editProfile(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        // Update the corresponding user record
        $user = User::where('email', $doctor->email)->first();

        // If the email is the same as the existing one or it's unique for other users
        if ($user && ($request->input('email') === $doctor->email || User::where('email', $request->input('email'))->doesntExist())) {
            
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

            if ($request->hasFile('image')) {
                $filename = $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('profilePic', $filename, 'public');
                $user->image = $filename;
            }// public/storage/profilePic

            $user->save();

            // Wrap both updates in a transaction to ensure atomicity
            DB::beginTransaction();

            try {
                $doctor->name = $request->input('name');
                $doctor->gender = $request->input('gender');
                $doctor->phoneno = $request->input('phoneno');
                $doctor->email = $request->input('email');
                $doctor->deptid = $request->input('deptid');
                $doctor->education = $request->input('education');
                $doctor->experience = $request->input('experience');
                $doctor->dob = $request->input('dob');
                $doctor->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

                $doctor->save();

                DB::commit();

                return redirect('/doctor/profile')->with('success', 'Your profile has been updated');
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->back()->with('success', 'ERROR! Unable to update your profile.');
            }
        } else {
            return redirect()->back()->with('success', 'Unsuccessful, the email already exists.');
        }
    }

    // Manage Patient
    public function AddPatient(Request $request)
    {
        //create new user record
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->usertype = $request->usertype;
        $user->ic = $request->ic;
        $user->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $user->save();

        //insert data into nurse table
        $patient = new Patient();
        $patient->ic = $request->ic;
        $patient->name = $request->name;
        $patient->gender = $request->gender;
        $patient->phoneno = $request->phoneno;
        $patient->age = $request->age;
        $patient->dob = $request->dob;
        $patient->address = $request->address;
        $patient->weight = $request->weight;
        $patient->height = $request->height;
        $patient->bloodtype = $request->bloodtype;
        $patient->email = $request->email;
        $patient->password = Hash::make($request->password);
        $patient->usertype = $request->usertype;
        $patient->status = $request->status;
        $patient->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $patient->save();

        return redirect('/doctor/patientList')->with('success', 'New patient has been successfully added');
    }

    public function EditPatient(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient->ic = $request->input('ic');
        $patient->name = $request->input('name');
        $patient->gender = $request->input('gender');
        $patient->phoneno = $request->input('phoneno'); 
        $patient->dob = $request->input('dob');
        $patient->age = $request->input('age'); 
        $patient->address = $request->input('address'); 
        $patient->weight = $request->input('weight');  
        $patient->height = $request->input('height'); 
        $patient->bloodtype = $request->input('bloodtype'); 
        $patient->email = $request->input('email'); 
        $patient->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $patient->save();

        // Update the corresponding user record
        $user = User::where('ic', $patient->ic)->first();
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
            $user->save();
        }

        return redirect('/doctor/patientList')->with('success', 'Patient has been updated');
    }

    public function deletePatient($id)
    {
        $patient = Patient::findOrFail($id);
        $ic = $patient->ic;

        $patient->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE patient SET id = @counter:=@counter+1;');

        // Delete the corresponding user record
        User::where('ic', $ic)->delete();

        return redirect('/doctor/patientList')->with('success', 'Patient has been deleted');
    }

    //Manage Appointment
    public function AddAppointment(Request $request)
    {
        //insert data into nurse table
        $appointment = new Appointments();
        $appointment->patientid = $request->patientid;
        $appointment->docid = $request->docid;
        $appointment->deptid = $request->deptid;
        $appointment->date = $request->date;

        // Convert time from '2:00 PM - 2:30 PM' to 'Y-m-d H:i:s' format
        $timeRange = $request->time;
        $timeParts = explode(' - ', $timeRange);
        $startDateTime = date('Y-m-d H:i:s', strtotime($timeParts[0]));
        // If you need to use the end time as well, you can convert it in a similar way.
        // $endDateTime = date('Y-m-d H:i:s', strtotime($timeParts[1]));

        $appointment->time = $startDateTime;
        $appointment->status = $request->status;
        $appointment->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $appointment->save();

        return redirect('/doctor/appointmentList')->with('success', 'New Appointment has been successfully added');
    }

    public function EditAppointment(Request $request, $id)
    {
        $appointment = Appointments::find($id);
        
        $appointment->patientid = $request->input('patientid');
        $appointment->docid = $request->input('docid');
        $appointment->deptid = $request->input('deptid'); 
        $appointment->date = $request->input('date'); 
        $appointment->time = $request->input('time'); 
        $appointment->status = $request->input('status');
        $appointment->save();

        return redirect('/doctor/appointmentList')->with('success', 'Appointment has been updated');
    }

    public function deleteAppointment($id)
    {
        $appointment = Appointments::findOrFail($id);

        $appointment->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE appointment SET id = @counter:=@counter+1;');

        return redirect('/doctor/appointmentList')->with('success', 'Appointment has been deleted');
    }

    //Manage medicine
    public function AddMedicine(Request $request) // Add medicine
    {
        //create new medicine record
        $medicine = new Medicine();
        $medicine->name = $request->input('name');
        $medicine->stock = $request->input('stock');
        $medicine->price = $request->input('price');
        $medicine->desc = $request->input('desc');
        $medicine->save();

        return redirect('/doctor/medicines')->with('success', 'New medicine has been successfully added');
    }

    // Edit medicine
    public function EditMedicine(Request $request, $id)
    {
        $medicine = Medicine::find($id);
        $medicine->name = $request->input('name');
        $medicine->stock = $request->input('stock');
        $medicine->price = $request->input('price');
        $medicine->desc = $request->input('desc');

        $medicine->save();

        return redirect('/doctor/medicines')->with('success', 'Medicine details has been updated');
    }

    // Delete medicine
    public function DeleteMedicine($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        
        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE medicine SET id = @counter:=@counter+1;');

        return redirect('/doctor/medicines')->with('success', 'Medicine has been deleted');
    }
   
    //Appointment record
    public function getMedicinePrice($id)
    {
        $medicine = Medicine::findOrFail($id);
        return response()->json(['price' => $medicine->price]);
    }
    
    public function AddAppointmentRecord(Request $request, $id)
    {
        // Get the currently logged-in doctor
        $doctor = Doctor::where('email', Auth::user()->email)->first();
    
        // // Insert data into medrecord table
        // $medRec = new MedRecord();
        // $medRec->aptid = $id;
        // $medRec->serviceid = $request->input('serviceid');
        // $medRec->desc = $request->input('desc')['med_record'];
        // $medRec->datetime = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        // $medRec->patientid = $request->input('patientid');
        // $medRec->docid = $doctor->id;
        // $medRec->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        // $medRec->save();


        // Find the existing medrecord by aptid
        $medRec = MedRecord::where('aptid', $id)->first();

        // Check if the record with the given aptid exists
        if (!$medRec) {
            // If the record doesn't exist, create a new instance of MedRecord
            $medRec = new MedRecord();
            $medRec->aptid = $id;
        }

        // Update the fields
        $medRec->serviceid = $request->input('serviceid');
        $medRec->desc = $request->input('desc')['med_record'];
        $medRec->datetime = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $medRec->patientid = $request->input('patientid');
        $medRec->docid = $doctor->id;

        // Set the created_at and updated_at timestamps
        if (!$medRec->exists) {
            $medRec->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        }
        $medRec->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        // Save the record to the database
        $medRec->save();

       //Med Prescription
        // Get the selected medicine values from the request
        $selectedMedicines = $request->input('medicines')['id'] ?? [];
        $quantities = Arr::wrap($request->input('qty'));
        $descriptions = Arr::wrap($request->input('desc')['med_prescription']);

        // Validate if all arrays have the same length
        if (count($selectedMedicines) === count($quantities) && count($selectedMedicines) === count($descriptions)) {
            $count = count($selectedMedicines);

            // Loop through each selected medicine
            for ($i = 0; $i < $count; $i++) {
                // Split the medicine into ID and name directly from the array
                list($medicineId, $medicineName) = explode(':', $selectedMedicines[$i]);

                // Validate if the required data is not empty before saving
                if (!empty($medicineId) && !empty($medicineName) && !empty($quantities[$i]) && !empty($descriptions[$i])) {
                    // Insert data into medprescription table
                    $medPres = new MedPrescription();
                    $medPres->aptid = $id;
                    $medPres->medicineid = $medicineId;
                    $medPres->name = $medicineName;
                    $medPres->qty = $quantities[$i];
                    $medPres->desc = $descriptions[$i];
                    $medPres->docid = $doctor->id;
                    $medPres->patientid = $request->input('patientid');
                    $medPres->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
                    $medPres->save();
                } 
                else {
                    // Handle the case when required data is missing or empty
                    // You can log an error or add a validation error message here
                    // depending on your application's requirements.
                    // For example, you can log an error message:
                    // Log::error("Incomplete data for medicine entry $i");
                    // Or add a validation error message to be displayed to the user:
                    // return redirect()->back()->withErrors(['error' => "Incomplete data for medicine entry $i"]);
                }
            }
        } else {
            // Handle the case when arrays have different lengths
            // You can log an error or add a validation error message here
            // depending on your application's requirements.
            // For example, you can log an error message:
            // Log::error("Mismatched array lengths for selected medicines, quantities, and descriptions");
            // Or add a validation error message to be displayed to the user:
            // return redirect()->back()->withErrors(['error' => "Mismatched array lengths for selected medicines, quantities, and descriptions"]);
        }

        // Check if the checkbox is checked
        if ($request->has('scheduleNext')) {
            // Checkbox is checked, so insert the data into the database
            $apt = new Appointments();
            $apt->patientid = $request->input('patientid');
            $apt->docid = $doctor->id;
            $apt->deptid = $doctor->deptid;
            $apt->status = 1;
            $apt->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

            // Check if the date and time inputs are provided
            if ($request->has('date')) {
                $apt->date = $request->input('date');
            }

            if ($request->has('time')) {
                $apt->time = $request->input('time');
            }

            $apt->save();
        }

        return redirect('/doctor/appointmentList')->with('success', 'Successfully inserted');
    }

    public function filterReportList(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $filteredReports = MedRecord::join('patient', 'medrecord.patientid', '=', 'patient.id')
                        ->select('medrecord.*', 'patient.*')
                        ->whereBetween('medrecord.datetime', [$startDate, $endDate])
                        ->get();

        return view('doctor.contents.reports', compact('filteredReports'));
    }

    //status attendance
    public function AttendAppointment($appointment_id)
    {
        return $this->updateAppointmentStatus($appointment_id, 1);
    }

    public function AbsentAppointment($appointment_id)
    {
        return $this->updateAppointmentStatus($appointment_id, 2);
    }

    private function updateAppointmentStatus($appointment_id, $status)
    {
        // Get the currently logged-in doctor
        $doctor = Doctor::where('email', Auth::user()->email)->first();
        
        // Get the appointment record
        $appointment = Appointments::find($appointment_id);

        if (!$appointment) {
            return redirect('/doctor/dashboard')->with('error', 'Appointment not found');
        }

        // Check if an attendance record exists for the given appointment
        $attendance = Attendance::where('aptid', $appointment_id)->first();

        if ($attendance) {
            // If an attendance record exists, update its status
            $attendance->status = $status;
            $attendance->save();
        } else {
            // If no attendance record exists, create a new one
            $attendance = new Attendance();
            $attendance->aptid = $appointment_id;
            $attendance->status = $status;
            $attendance->docid = $doctor->id;
            $attendance->patientid = $appointment->patientid;
            $attendance->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
            $attendance->save();
        }

        // Update the status in the appointments table as well
        $appointment->status = $status;
        $appointment->save();

        return redirect('/doctor/dashboard')->with('success', 'Successfully updated');
    }

   
}
