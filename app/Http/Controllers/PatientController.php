<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Patient; 
use App\Models\Doctor;
use App\Models\Nurse; 

use App\Models\Department;
use App\Models\DocSchedule;
use App\Models\Appointments;
use App\Models\Attendance;
use App\Models\Medicine;
use App\Models\MedRecord;
use App\Models\MedInvoice;
use App\Models\Medprescription;
use App\Models\Notification_user;

class PatientController extends Controller
{

    
    public function index()
    {
        $id=Auth()->user()->id;
        $email=Auth()->user()->email;
        $name=Auth()->user()->name;

        $patient = Patient::where('email', Auth::user()->email)->first();

        $countdown =  Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        ->select('appointment.*')
        ->where('patient.email', $email )
        ->orderByDesc('appointment.id')
        ->first();

        if(empty($countdown->date)){
            $countdownDate = Carbon::parse('2023-08-01 00:00:00')->format('Y-m-d H:i:s');
        }else{
            $countdownDate = Carbon::parse($countdown->date . ' ' . $countdown->time)->format('Y-m-d H:i:s');
        }

        $aptlatests =  Appointments::join('doctor', 'appointment.docid', '=', 'doctor.id')
        ->join('department', 'appointment.deptid', '=', 'department.id')
        ->join('patient', 'appointment.patientid', '=', 'patient.id')
        ->select('appointment.*', 'doctor.name as doctor_name', 'department.name as dept_name')
        ->where('patient.email', $email )
        ->orderByDesc('appointment.id')
        ->limit(1)
        ->get();

        $appointments = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        ->join('medrecord', 'appointment.id', '=', 'medrecord.aptid')
        ->join('medservice', 'medrecord.serviceid', '=', 'medservice.id')
        ->select('appointment.*', 'patient.id as patient_id','patient.name as patient_name', 'medservice.type as type_service', 'doctor.name as doctor_name', 'medrecord.desc as descs')
        ->where('patient.email', $email )
        ->get();

        $listmedicines = Medicine::select('medicine.*')
        ->join('medprescription', 'medicine.id', '=', 'medprescription.medicineid')
        ->join('patient', 'patient.id', '=', 'medprescription.patientid')
        ->where('patient.email', '=', $email)
        ->distinct()
        ->get();

        $listDoctors = Doctor::select('doctor.*','department.name as dept_name','users.image as image')
        ->join('users', 'doctor.email', '=', 'users.email')
        ->join('medrecord', 'doctor.id', '=', 'medrecord.docid')
        ->join('department', 'doctor.deptid', '=', 'department.id')
        ->join('patient', 'patient.id', '=', 'medrecord.patientid')
        ->where('patient.email', '=', $email)
        ->distinct()
        ->get();

        $notify = Notification_user::where('userid', '=', $id)
        ->get();


        $detailpatients = Patient::where('email', $email)->get();


        // calendar
        $calendarEvents = [];
        $cYear = Carbon::now('Asia/Kuala_Lumpur')->format('Y'); // now year
        $today = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d'); // Today's date

        // Loop through each month of the year
        for ($month = 1; $month <= 12; $month++) {
            $cMonth = sprintf('%02d', $month); // Format the month as '01', '02', etc.

            // Get the last day of the current month
            $lastDayOfMonth = Carbon::create($cYear, $cMonth)->endOfMonth();

            // Loop through each day of the month
            for ($date = Carbon::create($cYear, $cMonth, 1); $date <= $lastDayOfMonth; $date->addDay()) {
                $cDate = $date->format('Y-m-d');

                if ($cDate < $today) { // past appointment

                    $totalAttend = 0;
                    
                    $totalDone = DB::table('appointment') // total done
                    ->where('date', $cDate)
                    ->where('patientid', $patient->id) 
                    ->whereExists(function ($query) { // have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                    $totalCancel = DB::table('appointment') // total cancel
                    ->where('date', $cDate)
                    ->where('patientid', $patient->id) 
                    ->whereNotExists(function ($query) { // not have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                } else { // today / next apt 

                    $totalDone = DB::table('appointment') // total done
                    ->where('date', $cDate)
                    ->where('patientid', $patient->id) 
                    ->whereExists(function ($query) { // have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();   
                    
                    $totalAttend = DB::table('appointment')
                    ->where('date', $cDate)
                    ->where('patientid', $patient->id) 
                    ->where('status', 1) // status attend
                    ->whereNotExists(function ($query) { // not medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                    $totalCancel = DB::table('appointment')
                    ->where('date', $cDate)
                    ->where('patientid', $patient->id) 
                    ->where('status', 2) // status cancel
                    ->count(); 
                }

                $events = []; // Initialize an array to store events for this day

                if ($totalCancel > 0) { // event cancel apt
                    $events[] = [
                        'title' => $totalCancel . " - Cancel",
                        'color' => '#DC143C',
                        'borderColor' => '#DC2127', // adjust color if want border
                    ];
                }
                
                if ($totalAttend > 0) { // event attend but not done
                    $events[] = [
                        'title' => $totalAttend . " - Attend",
                        'color' => '#FF9F32',
                        'borderColor' => '#FF8303',
                    ];
                }
                
                if ($totalDone > 0) { // event done apt
                    $events[] = [
                        'title' => $totalDone . " - Done",
                        'color' => '#51B749',
                        'borderColor' => '#51B749',
                    ];
                }

                // Add events for this day to the calendarEvents array
                foreach ($events as $event) {
                    $calendarEvents[] = [
                        'title' => $event['title'],
<<<<<<< Updated upstream
                        'start' => $cDate,
                        'url' => url('doctor/appointmentList?date=' . $cDate . '&sort=asc'),
=======
                        'start' => $currentDate,
                        'url' => url('patient/appointmentListFilter/' . $currentDate . ''),
>>>>>>> Stashed changes
                        'backgroundColor' => $event['color'],
                        'borderColor' => $event['borderColor'],
                        'allDay' => true,
                    ];
                }
            }
        } // End calendar

        return view('patient.contents.dashboard', compact('name','aptlatests','countdownDate','appointments','listmedicines',
        'detailpatients','listDoctors','notify','calendarEvents'));
    }

    public function viewAppointmentList()
    {


        $email=Auth()->user()->email; //dapatemail dr login

        $appointments = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        ->join('department', 'appointment.deptid', '=', 'department.id')
        ->select('appointment.*', 'patient.id as patient_id','patient.name as patient_name', 'doctor.name as doctor_name', 'department.name as dept_name')
        ->where('patient.email', $email )
        // ->where('appointment.status', 0)
        ->get();

        foreach ($appointments as $appointment) { //total appointment
            $appointment->appt_count = MedRecord::where('aptid', $appointment->id)
            ->where('appointment.status', 1)
            ->join('appointment', 'appointment.id', '=', 'medrecord.aptid')
            ->count();
        }


        return view('patient.contents.appointmentList', compact('appointments'));
    }

    public function viewAppointmentListFilter($date1) 
    {


        $email=Auth()->user()->email; //dapatemail dr login

        $appointments = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        ->join('department', 'appointment.deptid', '=', 'department.id')
        ->select('appointment.*', 'patient.id as patient_id','patient.name as patient_name', 'doctor.name as doctor_name', 'department.name as dept_name')
        ->where('patient.email', $email )
        ->where('appointment.date', $date1)
        ->get();


        return view('patient.contents.appointmentList', compact('appointments'));
    }

    public function viewReport($id) //id medrecord
    {
         //get the details of current logged in patient
        //$patient = Patient::where('email', Auth::user()->email)->first();

        $record = MedRecord::with('appointment', 'patient', 'attendingDoctor', 'medPrescription', 'medInvoice')
                ->where('refnum', $id)
                ->first();
        
       // Get the previous record with the same patient ID
       $previousRecord = MedRecord::join('patient', 'medrecord.patientid', '=', 'patient.id')
                        ->where('medrecord.patientid', $record->patientid)
                        ->where('medrecord.id', '<', $record->id)
                        ->orderBy('medrecord.id', 'desc')
                        ->first();

       // Get the previous medicines for the medicine record
       $prevMedicine = collect(); // Initialize an empty collection

       if ($previousRecord) {
       $prevMedicine = Medprescription::join('patient', 'medprescription.patientid', '=', 'patient.id')
           ->join('appointment', 'medprescription.aptid', '=', 'appointment.id')
           ->where('medprescription.patientid', $record->patientid)
           ->where('medprescription.aptid', $previousRecord->aptid) // Use the aptid from the previous record
           ->select('medprescription.name as prevMedName')
           ->orderBy('medprescription.id', 'desc')
           ->take(5) // Take the last 5 records
           ->get()
           ->reverse(); // Reverse the order to display the most recent medicine first
       }

        // Join with medservice table
        $record->load('medService');

        // Join with medservice table for the previous record as well
        if ($previousRecord) {
            $previousRecord->load('medService');
        }

        $medicines = MedRecord::join('medprescription', 'medrecord.aptid', '=', 'medprescription.aptid')
                    ->where('medrecord.id', $id)
                    ->get(); // Use first() instead of get()

                // Now you can access the name property

        //get the next appointment record
<<<<<<< Updated upstream
        $upcomingAppointment = null; // Initialize the variable to avoid potential issues

        $upcomingAppointments = Appointments::where('patientid', $patient->id)
=======
        //$currentDateTime = Carbon::now();
    
        $upcomingAppointment = null; // Initialize the variable to avoid potential issues

        $patientId = $record->patient->id;

        $upcomingAppointments = Appointments::where('patientid', $patientId)
>>>>>>> Stashed changes
                                ->where('date', '>', date('Y-m-d'))
                                ->orderBy('date')
                                ->orderBy('time')
                                ->get();

        return view('patient.contents.report', compact('record', 'previousRecord', 
        'prevMedicine', 'medicines', 'upcomingAppointments'));
    }

    //get the doctor schedule date 
    public function getDoctorSchedule($doctorId)
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $doctorSchedule = DocSchedule::where('docid', $doctorId)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get();

        return response()->json($doctorSchedule);
    }

    public function viewReportList()
    {
        $email=Auth()->user()->email; //dapatemail dr login

        $medrcs = MedRecord::join('patient', 'medrecord.patientid', '=', 'patient.id')
        ->join('appointment', 'medrecord.aptid', '=', 'appointment.id')
        ->join('doctor', 'medrecord.docid', '=', 'doctor.id')
        ->join('medservice', 'medrecord.serviceid', '=', 'medservice.id')
        ->select('medrecord.*','doctor.name as doctor_name','medservice.type as service_type','appointment.id as aptid')
        ->where('patient.email', $email )
        ->get();

        $doctors = Doctor::all();
        $patients = Patient::where('email', $email)->get();
        $departments = Department::all();

        return view('patient.contents.reportList', compact('medrcs','doctors','patients','departments'));
    }

    public function viewMedRecord()
    {
        $email=Auth()->user()->email; //dapatemail dr login

        $medrcs = MedRecord::join('patient', 'medrecord.patientid', '=', 'patient.id')
        ->join('appointment', 'medrecord.aptid', '=', 'appointment.id')
        ->join('doctor', 'medrecord.docid', '=', 'doctor.id')
        ->join('medservice', 'medrecord.serviceid', '=', 'medservice.id')
        ->select('medrecord.*','doctor.name as doctor_name','medservice.type as service_type','appointment.id as aptid')
        ->where('patient.email', $email )
        ->get();


        return view('patient.contents.medrecord', compact('medrcs'));
    }

    public function viewMedPrescription()
    {
        $email=Auth()->user()->email; //dapatemail dr login

        $medprescriptions = Medprescription::join('patient', 'medprescription.patientid', '=', 'patient.id')
        ->join('appointment', 'medprescription.aptid', '=', 'appointment.id')
        ->join('nurse', 'medprescription.nurseid', '=', 'nurse.id')
        ->join('medicine', 'medprescription.medicineid', '=', 'medicine.id')
        ->select('medprescription.*','nurse.name as nurse_name','medicine.name as medicine_name','appointment.id as aptid')
        ->where('patient.email', $email )
        ->get();


        return view('patient.contents.medprescription', compact('medprescriptions'));
    }


    public function viewProfile()
    {
        $email=Auth()->user()->email; //dapatemail dr login
        $name=Auth()->user()->name;

        $userdetails = Patient::where('email', $email)->get();
        $detailpatients = Patient::where('email', $email)->get();


        return view('patient.contents.profile', compact('userdetails','detailpatients','name'));
    }


    ////////////////////////////////PROFILE///////////////////////////////////////////////////////////////////////


    public function EditProfile(Request $request, $id)
    {
        $patient = Patient::find($id);

        // Update the corresponding user record
        $user = User::where('email', $patient->email)->first();
        
        // If the user record exists and the email is not changed or the new email is unique
        if ($user && ($request->input('email') === $patient->email || User::where('email', $request->input('email'))->doesntExist())) {
            
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
                $patient->name = $request->input('name');
                $patient->age = $request->input('age'); 
                $patient->gender = $request->input('gender'); 
                $patient->phoneno = $request->input('phoneno'); 
                $patient->email = $request->input('email');
                $patient->address = $request->input('address');
                $patient->weight = $request->input('weight');
                $patient->height = $request->input('height');
                $patient->bloodtype = $request->input('bloodtype');
                $patient->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

                $patient->save();

                DB::commit();
                
                return redirect('/patient/profile')->with('success', 'Your profile has been updated');
            } catch (\Exception $e) {
                DB::rollBack();
                
                return redirect()->back()->with('success', 'ERROR! Unable to updating your profile.');
            }
        } else {
            return redirect()->back()->with('success', 'Unsuccessful, the email already exists.');
        }
    }

    /////////////////////////////////Appointment//////////////////////////////////////////////////////////////////


    // public function AddAppointment(Request $request)
    // {
    //      // Get the currently logged-in doctor
    //      $patient = Patient::where('email', Auth::user()->email)->first();
    
    //      if (!$patient) {
    //          // Handle the case if the logged-in user is not a doctor
    //          // For example, redirect them to a different page or show an error message
    //          // You can also return an empty array of appointments if you prefer
    //      }
     
    //     //$patientId = $patient->id;

    //     // Get the input data
    //     $patientId = $patient->id;;
    //     $doctorId = $request->docid;
    //     $deptId = $request->deptid;
    //     $date = $request->date;
    //     $time = $request->time;
    
    //     // Convert time from '2:00 PM - 2:30 PM' to 'H:i' format
    //     $timeParts = explode(' - ', $time);
    //     $startTime = Carbon::createFromFormat('h:i A', $timeParts[0])->format('H:i');
    //     $endTime = Carbon::createFromFormat('h:i A', $timeParts[1])->format('H:i');
    
    //     // Check for overlapping appointments
    //     $overlappingAppointments = DB::table('appointment')
    //         ->where('docid', $doctorId)
    //         ->where('date', $date)
    //         ->where(function ($query) use ($startTime, $endTime) {
    //             $query->where(function ($query) use ($startTime, $endTime) {
    //                 $query->where('time', '>=', $startTime)
    //                     ->where('time', '<', $endTime);
    //             })
    //             ->orWhere(function ($query) use ($startTime, $endTime) {
    //                 $query->where('time', '<=', $startTime)
    //                     ->where('time', '>', $startTime);
    //             })
    //             ->orWhere(function ($query) use ($startTime, $endTime) {
    //                 $query->where('time', '>=', $startTime)
    //                     ->where('time', '<=', $endTime);
    //             });
    //         })
    //         ->count();
    
    //     // If there are overlapping appointments, display an alert
    //     if ($overlappingAppointments > 0) {
    //         return redirect()->back()->with('error', 'The selected time slot is already booked. Please choose another time.');
    //     }
    
    //     // If the time slot is available, save the new appointment

    //     //insert data into nurse table
    //     $appointment = new Appointments();
    //     $appointment->patientid = $patientId;
    //     $appointment->docid = $doctorId;
    //     $appointment->deptid = $deptId;
    //     $appointment->date = $date;

    //     // Convert time from '2:00 PM - 2:30 PM' to 'Y-m-d H:i:s' format
    //     $timeRange = $request->time;
    //     $timeParts = explode(' - ', $timeRange);
    //     $startDateTime = date('Y-m-d H:i:s', strtotime($timeParts[0]));
    //     // If you need to use the end time as well, you can convert it in a similar way.
    //     // $endDateTime = date('Y-m-d H:i:s', strtotime($timeParts[1]));

    //     $appointment->time = $startDateTime;
    //     $appointment->status = 0;
    //     $appointment->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
    //     $appointment->save();

    //     return redirect('/patient/appointmentList')->with('success', 'New Appointment has been successfully added');
    // }

    public function EditAppointment(Request $request, $id)
    {
        $appointment = Appointments::find($id);

        $appointment->status = 2;
        $appointment->save();

        $attend = new Attendance();
        $attend->aptid = $id;
        $attend->status = 2;
        $attend->reason = $request->input('reason');
        $attend->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $attend->save();


        return redirect('/patient/appointmentList')->with('success', 'Appointment has been cancel');
    }


}