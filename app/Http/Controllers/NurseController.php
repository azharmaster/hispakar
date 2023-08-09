<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Patient; 
use App\Models\Doctor;
use App\Models\Nurse; 
use App\Models\Profile;  
use App\Models\Medicine; 
use App\Models\Room; 
use App\Models\Department; 
use App\Models\Appointments;
use App\Models\Attendance;
use App\Models\DocSchedule;
use App\Models\MedRecord;
use App\Models\Medprescription;
use Illuminate\Support\Facades\Auth;

class NurseController extends Controller
{
    public function index()
    { 
        // Get the current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $nurse = Nurse::where('email', Auth::user()->email)->first();

        // Get the current date in the 'Y-m-d' format
        $currentDate = Carbon::now('Asia/Kuala_Lumpur')->toDateString();

        //card
        $totalapt = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
                    ->whereDate('appointment.date', $currentDate)
                    ->count();

        $totaldoc = Doctor::where('doctor.deptid', $nurse->deptid)
                    ->count();
                    
        $totalpatient = Patient::all()->count();
        $totalroom = Room::all()->count();

        //gender
        $totalmale = Patient::where('gender', 'male')->count();
        $totalfemale = Patient::where('gender', 'female')->count();

        //appointment statistic
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

            $totalattend[] = MedRecord::whereBetween('datetime', [$startDate, $endDate])->count();
            $totalcancel[] = Appointments::whereMonth('date', $month)->whereYear('date', $year)->where('status', 3)->count();
        }

        //Age
        $children = Patient::where('age', '<=', 12)->count(); // Age up to 12 years
        $teenage = Patient::whereBetween('age', [13, 19])->count(); // Age between 13 and 19 years
        $adult = Patient::whereBetween('age', [20, 64])->count(); // Age between 20 and 64 years
        $older = Patient::where('age', '>=', 65)->count(); // Age 65 years and above

        // calendar
        $calendarEvents = [];
        $currentYear = now()->format('Y'); // Current year
        $today = now()->format('Y-m-d'); // Today's date

        // Loop through each month of the year
        for ($month = 1; $month <= 12; $month++) {
            $currentMonth = sprintf('%02d', $month); // Format the month as '01', '02', etc.

            // Get the last day of the current month
            $lastDayOfMonth = Carbon::create($currentYear, $currentMonth)->endOfMonth();

            // Loop through each day of the month
            for ($date = Carbon::create($currentYear, $currentMonth, 1); $date <= $lastDayOfMonth; $date->addDay()) {
                $currentDate = $date->format('Y-m-d');

                if ($currentDate < $today) { // past appointment

                    $totalAttend = 0;
                    
                    $totalDone = DB::table('appointment') // total done
                    ->where('date', $currentDate)
                    ->where('deptid', $nurse->deptid) // by user department
                    ->whereExists(function ($query) { // have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                    $totalCancel = DB::table('appointment') // total cancel
                    ->where('date', $currentDate)
                    ->where('deptid', $nurse->deptid) // by user department
                    ->whereNotExists(function ($query) { // not have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                } else { // today / next apt 

                    $totalDone = DB::table('appointment') // total done
                    ->where('date', $currentDate)
                    ->where('deptid', $nurse->deptid) // by user department
                    ->whereExists(function ($query) { // have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();   
                    
                    $totalAttend = DB::table('appointment')
                    ->where('date', $currentDate)
                    ->where('deptid', $nurse->deptid) // by user department
                    ->where('status', 1) // status attend
                    ->whereNotExists(function ($query) { // not medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                    $totalCancel = DB::table('appointment')
                    ->where('date', $currentDate)
                    ->where('deptid', $nurse->deptid) // by user department
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
                        'start' => $currentDate,
                        'url' => url('doctor/appointmentList?date=' . $currentDate . '&sort=asc'),
                        'backgroundColor' => $event['color'],
                        'borderColor' => $event['borderColor'],
                        'allDay' => true,
                    ];
                }
            }
        } // End calendar

        $medicines = Medicine::all();
        $appointments = Appointments::all();

        $patients = Patient::all();
        $rooms = Room::all();
        $doctors = Doctor::all();

        //today's apt table
        // Get the current date in the 'Y-m-d' format
        $currentDate = Carbon::now('Asia/Kuala_Lumpur')->toDateString();

        $aptDs = Appointments::leftJoin('attendance', 'appointment.id', '=', 'attendance.aptid')
        ->join('patient', 'appointment.patientid', '=', 'patient.id')
        ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        ->select('appointment.id as appointment_id', 'patient.id as patient_id', 'appointment.*', 'patient.*', 'attendance.status', 'attendance.reason') // Include the 'reason' column in the select
        ->where('appointment.deptid', $nurse->deptid)
        ->whereDate('appointment.date', $currentDate) 
        ->orderBy('appointment.time', 'asc')
        // ->take(5)
        ->get();


        return view('nurse.contents.dashboard', compact(
            // for card
            'totalpatient', 'totalroom','totaldoc','totalapt', 
            //for chart by gender
            'totalmale', 'totalfemale',
            //for appoinment statistic by month
            'totalattend', 'totalcancel',
            //for pie chart by ages
            'children', 'teenage', 'adult', 'older',

            'medicines', 'calendarEvents',  
            'appointments', 'aptDs', 'currentDate'));
    }

    public function viewProfile()
    {
        // Get the currently authenticated user
        $user = auth()->user();

        $departments = Department::all();

        if ($user->usertype === 3) {
            // Get the nurse's name from the 'nurse' table based on the email
            $nurse = Nurse::where('email', $user->email)->first();

            $department = Department::find($nurse->deptid);

            return view('nurse.contents.profile', [
                'id' => $nurse->id,
                'name' => $nurse->name,
                'ic' => $nurse->ic,
                'email' => $nurse->email,
                'phoneno' => $nurse->phoneno,
                'address' => $nurse->address,
                'gender' => $nurse->gender,
                'dob' => $nurse->dob,
                'profilepic' => $nurse->profilepic,
                'deptid' => $nurse->deptid,
                'department' => $department,
            ])->with('departments', $departments);
        }
    }


    public function viewDoctorList()
    {
        $doctors = Doctor::all();
        $departments = Department::all();

        return view('nurse.contents.doctorList', compact('doctors', 'departments'));
    }

    public function viewPatientList()
    {
        $patients = Patient::all();

        return view('nurse.contents.patientList', compact('patients'));
    }

    public function viewRoomList()
    {
        $rooms = Room::all(); // Retrieve all rooms from the database

        return view('nurse.contents.roomList', compact('rooms'));
    }

    public function viewMedicineList()
    {
        $medicines = Medicine::all(); // Retrieve all medicines from the database

        return view('nurse.contents.medicineList', compact('medicines'));
    }

    public function viewMedRecordList()
    {
        // Retrieve the nurse based on the authenticated user's email
        $nurse = Nurse::where('email', Auth::user()->email)->first();
        $deptId = $nurse->deptId; // Check if the nurse exists and then get the deptId

        //belum ikut department nurse
        $medrcs = MedRecord::join('patient', 'medrecord.patientid', '=', 'patient.id')
        ->join('appointment', 'medrecord.aptid', '=', 'appointment.id')
        ->join('doctor', 'medrecord.docid', '=', 'doctor.id')
        ->join('medservice', 'medrecord.serviceid', '=', 'medservice.id')
        ->select('medrecord.*','doctor.name as doctor_name','medservice.type as service_type','appointment.id as aptid')
        ->get();

        return view('nurse.contents.medrecordList', compact('medrcs'));
    }

    public function viewMedicalReport($medrc_id) // medrecord table id
    {
       
        $record = MedRecord::with('appointment', 'patient', 'attendingDoctor', 'medPrescription', 'medInvoice')
        ->where('id', $medrc_id)
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

        $medicines = MedPrescription::join('medrecord', 'medrecord.aptid', '=', 'medprescription.aptid')
        ->where('medrecord.id', $medrc_id)
        ->select('medprescription.*', 'medprescription.desc as med_desc')
        ->get();

        //get the next appointment record
        $currentDateTime = Carbon::now();

        // Get patientid in this medrecord
        $patientid = MedRecord::where('id', $medrc_id)->pluck('patientid')->first();
    
        $upcomingAppointment = null; // Initialize the variable to avoid potential issues

        if ($patientid) {
            $upcomingAppointment = Appointments::where('patientid', $patientid)
                ->where(function ($query) use ($currentDateTime) {
                    $query->where('date', '>', $currentDateTime->toDateString())
                        ->orWhere(function ($query) use ($currentDateTime) {
                            $query->where('date', '=', $currentDateTime->toDateString())
                                ->where('time', '>', $currentDateTime->toTimeString());
                        });
                })
                ->get();
        }

        return view('nurse.contents.report', compact(
            'record','previousRecord','prevMedicine','upcomingAppointment', 
            'medicines'));
    }

    public function viewAppointmentList()
    {
        $nurse = Nurse::where('email', Auth::user()->email)->first();

        // Add $currentDate variable here
        $currentDate = Carbon::today()->toDateString();

        $appointments = Appointments::leftJoin('medrecord', 'medrecord.aptid', '=', 'appointment.id')
                        ->join('patient', 'appointment.patientid', '=', 'patient.id')
                        ->join('doctor', 'appointment.docid', '=', 'doctor.id')
                        ->join('department', 'appointment.deptid', '=', 'department.id')
                        ->select('appointment.*', 'patient.name as patient_name', 'patient.ic as patient_ic', 'doctor.name as doctor_name', 'department.name as dept_name', 'medrecord.status as medrecord_status')
                        ->where('appointment.deptid', $nurse->deptid)
                        ->get();    

        $doctors = Doctor::where('doctor.deptid', $nurse->deptid)
                    ->get();
        $patients = Patient::all();
        $departments = Department::all();

        return view('nurse.contents.appointmentList', compact('nurse', 'appointments', 'doctors', 'patients', 'departments', 'currentDate'));
    }

    public function viewAppointmentListDate($date)
    {
        // Reuse the viewAppointmentList() function to get the initial data
        $viewData = $this->viewAppointmentList()->getData();
    
        // Parse the selected date
        $selectedDate = Carbon::parse($date);
    
        // Filter appointments based on the selected date
        $filteredAppointments = $viewData['appointments']->filter(function ($appointment) use ($selectedDate) {
            return $appointment->date == $selectedDate->toDateString();
        });
    
        // Pass the filtered appointments and selected date to the view
        return view('nurse.contents.appointmentList', [
            'nurse' => $viewData['nurse'],
            'appointments' => $filteredAppointments,
            'doctors' => $viewData['doctors'],
            'patients' => $viewData['patients'],
            'departments' => $viewData['departments'],
            'selectedDate' => $selectedDate,
        ]);
    }

    public function EditProfile(Request $request, $id)
    {
        $nurse = Nurse::find($id);

        // Update the corresponding user record
        $user = User::where('email', $nurse->email)->first();
        
        // If the user record exists and the email is not changed or the new email is unique
        if ($user && ($request->input('email') === $nurse->email || User::where('email', $request->input('email'))->doesntExist())) {
            
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
                $nurse->name = $request->input('name');
                $nurse->gender = $request->input('gender');
                $nurse->phoneno = $request->input('phoneno');
                $nurse->email = $request->input('email');
                $nurse->deptid = $request->input('deptid'); 
                $nurse->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

                $nurse->save();

                DB::commit();
                
                return redirect('/nurse/profile')->with('success', 'Your profile has been updated');
            } catch (\Exception $e) {
                DB::rollBack();
                
                return redirect()->back()->with('success', 'ERROR! Unable to updating your profile.');
            }
        } else {
            return redirect()->back()->with('success', 'Unsuccessful, the email already exists.');
        }
    }



    /////// PATIENT ////////////////
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
        $patient->age = $request->age;
        $patient->phoneno = $request->phoneno;
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

        return redirect('/nurse/patientList')->with('success', 'New patient has been successfully added');
    }

    // Edit patient
    public function EditPatient(Request $request, $id)
    {
        $patient = Patient::find($id);
        $patient->ic = $request->input('ic');
        $patient->name = $request->input('name');
        $patient->gender = $request->input('gender');
        $patient->phoneno = $request->input('phoneno'); 
        $patient->dob = $request->input('dob');
        $patient->address = $request->input('address'); 
        $patient->age = $request->input('age'); 
        $patient->weight = $request->input('weight');  
        $patient->height = $request->input('height'); 
        $patient->bloodtype = $request->input('bloodtype'); 
        $patient->email = $request->input('email'); 
        $patient->status = $request->input('status'); 
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

        return redirect('/nurse/patientList')->with('success', 'Patient has been updated');
    }

    // Delete patient
    public function deletePatient($id)
    {
        $patient = Patient::findOrFail($id);
        $ic = $patient->ic;

        $patient->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE patient SET id = @counter:=@counter+1;');

        // Delete the corresponding user record
        User::where('ic', $ic)->delete();

        return redirect('/nurse/patientList')->with('success', 'Patient has been deleted');
    }

    /////// MEDICINE ///////////////
    
    public function AddMedicine(Request $request) // Add medicine
    {
        //create new medicine record
        $medicine = new Medicine();
        $medicine->name = $request->input('name');
        $medicine->stock = $request->input('stock');
        $medicine->price = $request->input('price');
        $medicine->desc = $request->input('desc');
        $medicine->save();

        return redirect('/nurse/medicineList')->with('success', 'New medicine has been successfully added');
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

        return redirect('/nurse/medicineList')->with('success', 'Medicine details has been updated');
    }

    // Delete medicine
    public function deleteMedicine($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        
        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE medicine SET id = @counter:=@counter+1;');

        return redirect('/nurse/medicineList')->with('success', 'Medicine has been deleted');
    }
    
    /////// ROOM ///////////////

    public function AddRoom(Request $request) // Add room
    {
     
        //insert data into room table
        $room = new Room();
        $room->name = $request->name;
        $room->type = $request->type;
        $room->desc = $request->desc;
        $room->staff_id = $request->staff_id;
        $room->status = $request->status;
        $room->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $room->save();

        return redirect('/nurse/roomList')->with('success', 'New Rooms has been successfully added');
    }

    // Edit room
    public function EditRoom(Request $request, $id)
    {
        $room = Room::find($id);
        
        $room->name = $request->input('name');
        $room->type = $request->input('type');
        $room->desc = $request->input('desc'); 
        $room->status = $request->input('status');
        $room->staff_id = $request->input('staff_id');
        $room->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $room->save();

        return redirect('/nurse/roomList')->with('success', 'Room has been updated');
    }

    // Delete room
    public function deleteRoom($id)
    {
        $room = Room::findOrFail($id);


        $room->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE room SET id = @counter:=@counter+1;');


        return redirect('/nurse/roomList')->with('success', 'Room has been deleted');
    }
    
    /////////////////////////////////Appointment//////////////////////////////////////////////////////////////////

    public function getDoctorSchedule($doctorId)
    {
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $doctorSchedule = DocSchedule::where('docid', $doctorId)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get();

        return response()->json($doctorSchedule);
    }

    public function getBookedAppointmentTimes($date)
    {
        // Fetch booked appointment times based on the selected date
        $bookedAppointmentTimes = Appointments::where('date', $date)
            ->pluck('time')
            ->toArray();
    
        return response()->json($bookedAppointmentTimes);
    }
    
    public function isTimeBooked(Request $request)
    {
        $selectedDate = $request->input('date');
        $startTime = $request->input('startTime');
        $endTime = $request->input('endTime');
    
        // Check if the selected time slot is booked
        $isBooked = Appointments::where('date', $selectedDate)
            ->where('time', '>=', $startTime)
            ->where('time', '<', $endTime)
            ->exists();
    
        return response()->json(['booked' => $isBooked]);
    }    

    public function AddAppointment(Request $request)
    {
        // Get the input data
        $patientId = $request->patientid;
        $doctorId = $request->docid;
        $deptId = $request->deptid;
        $date = $request->date;
        $time = $request->time;
    
        // Convert time from '2:00 PM - 2:30 PM' to 'H:i' format
        $timeParts = explode(' - ', $time);
        $startTime = Carbon::createFromFormat('h:i A', $timeParts[0])->format('H:i');
        $endTime = Carbon::createFromFormat('h:i A', $timeParts[1])->format('H:i');
    
        // Check for overlapping appointments
        $overlappingAppointments = DB::table('appointment')
            ->where('docid', $doctorId)
            ->where('date', $date)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($query) use ($startTime, $endTime) {
                    $query->where('time', '>=', $startTime)
                        ->where('time', '<', $endTime);
                })
                ->orWhere(function ($query) use ($startTime, $endTime) {
                    $query->where('time', '<=', $startTime)
                        ->where('time', '>', $startTime);
                })
                ->orWhere(function ($query) use ($startTime, $endTime) {
                    $query->where('time', '>=', $startTime)
                        ->where('time', '<=', $endTime);
                });
            })
            ->count();
    
        // If there are overlapping appointments, display an alert
        if ($overlappingAppointments > 0) {
            return redirect()->back()->with('error', 'The selected time slot is already booked. Please choose another time.');
        }
    
        // If the time slot is available, save the new appointment
        $appointment = new Appointments();
        $appointment->patientid = $patientId;
        $appointment->docid = $doctorId;
        $appointment->deptid = $deptId;
        $appointment->date = $date;

        // Convert time from '2:00 PM - 2:30 PM' to 'Y-m-d H:i:s' format
        $timeRange = $request->time;
        $timeParts = explode(' - ', $timeRange);
        $startDateTime = date('Y-m-d H:i:s', strtotime($timeParts[0]));
        // If you need to use the end time as well, you can convert it in a similar way.
        // $endDateTime = date('Y-m-d H:i:s', strtotime($timeParts[1]));

        $appointment->time = $startDateTime;
        $appointment->status = 1;
        $appointment->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $appointment->save();

        return redirect('/nurse/appointmentList')->with('success', 'New Appointment has been successfully added');
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
        $appointment->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $appointment->save();

        return redirect('/nurse/appointmentList')->with('success', 'Appointment has been updated');
    }

    
    public function deleteAppointment($id)
    {
        $appointment = Appointments::findOrFail($id);


        $appointment->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE appointment SET id = @counter:=@counter+1;');


        return redirect('/nurse/appointmentList')->with('success', 'Appointment has been deleted');
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
        // Get the appointment record
        $appointment = Appointments::find($appointment_id);

        if (!$appointment) {
            return redirect('/nurse/dashboard')->with('error', 'Appointment not found');
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
            $attendance->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
            $attendance->save();
        }

        // Update the status in the appointments table as well
        $appointment->status = $status;
        $appointment->save();

        return redirect('/nurse/dashboard')->with('success', 'Successfully updated');
    }




}

