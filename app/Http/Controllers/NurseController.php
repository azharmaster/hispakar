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
use App\Models\MedInvoice;
use App\Models\Medprescription;
use App\Models\DataPatient;

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

            //$totalattend[] = MedRecord::whereBetween('datetime', [$startDate, $endDate])->count();
            //$totalcancel[] = Appointments::whereMonth('date', $month)->whereYear('date', $year)->where('status', 3)->count();

            $totalattend[] = Appointments::whereMonth('date', $month)
                ->whereYear('date', $year)
                ->where('status', 1)
                ->where('deptid', $nurse->deptid)
                ->count();

            $totalcancel[] = Appointments::whereMonth('date', $month)
                ->whereYear('date', $year)
                ->where('status', 2)
                ->where('deptid', $nurse->deptid)
                ->count();
        }

        //Age
        $children = Patient::where('age', '<=', 12)->count(); // Age up to 12 years
        $teenage = Patient::whereBetween('age', [13, 19])->count(); // Age between 13 and 19 years
        $adult = Patient::whereBetween('age', [20, 64])->count(); // Age between 20 and 64 years
        $older = Patient::where('age', '>=', 65)->count(); // Age 65 years and above

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
                    ->where('deptid', $nurse->deptid) // by user department
                    ->whereExists(function ($query) { // have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                    $totalCancel = DB::table('appointment') // total cancel
                    ->where('date', $cDate)
                    ->where('deptid', $nurse->deptid) // by user department
                    ->whereNotExists(function ($query) { // not have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                } else { // today / next apt 

                    $totalDone = DB::table('appointment') // total done
                    ->where('date', $cDate)
                    ->where('deptid', $nurse->deptid) // by user department
                    ->whereExists(function ($query) { // have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();   
                    
                    $totalAttend = DB::table('appointment')
                    ->where('date', $cDate)
                    ->where('deptid', $nurse->deptid) // by user department
                    ->where('status', 1) // status attend
                    ->whereNotExists(function ($query) { // not medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                    $totalCancel = DB::table('appointment')
                    ->where('date', $cDate)
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
                        'start' => $cDate,
                        'url' => route('nurse.appointmentList', ['date' => $cDate]),
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
        ->select('appointment.id as appointment_id', 'patient.id as patient_id', 'appointment.*', 'patient.*', 'attendance.status', 'attendance.reason', 'attendance.queueid') // Include the 'reason' column in the select
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
        // Get the nurse information from the session
        $nurse = Nurse::where('email', Auth::user()->email)->first();
    
        // Retrieve deptid from the nurse model
        $deptId = $nurse->deptid;

        $doctors = Doctor::where('deptid', $deptId)->get();
        $departments = Department::all();
    
        return view('nurse.contents.doctorList', compact('doctors', 'departments'));
    }
    

    public function viewPatientList()
    {
        $patients = Patient::all();

        return view('nurse.contents.patientList', compact('patients'));
    }

    public function viewPatientProfile(Request $request, $id) //profile doctor
    {

        $patientdetails = Patient::where('patient.id', $id)
        ->join('users', 'users.email', '=', 'patient.email')
        ->get();

        $totaloperation = MedRecord::where('patientid', $id)
        ->count('patientid');

        $totalapt = Appointments::where('patientid', $id)
        ->where('status', 1)
        ->count('id');

        $doctors = MedRecord::where('patientid', $id)
        ->select(DB::raw('(SELECT name FROM doctor WHERE id = docid) as doctor'))
        ->distinct()
        ->get();

        $listmedicines = Medicine::select('medicine.*')
        ->join('medprescription', 'medicine.id', '=', 'medprescription.medicineid')
        ->where('medprescription.patientid', '=', $id)
        ->distinct()
        ->get();


        $appointments = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        ->join('medrecord', 'appointment.id', '=', 'medrecord.aptid')
        ->select('appointment.*', 'patient.id as patient_id', 'patient.name as patient_name', 'doctor.name as doctor_name', 'medrecord.desc as descs')
        ->where('patient.id', $id)
        ->get();

        // Get unique doctor names from the collection
        $doctorNames = $appointments->pluck('doctor_name')->unique();
    
        $totalPastAppointments = MedRecord::join('appointment', 'medrecord.aptid', '=', 'appointment.id')
        ->leftJoin('attendance', 'appointment.id', '=', 'attendance.aptid')
        ->where('appointment.patientid', $id)
        ->whereDate('appointment.date', '<', now()) // Filter past appointments based on the current date
        ->count('appointment.id');

        $medRecords = MedRecord::with('medservice')
        ->where('patientid', $id)
        ->orderByDesc('created_at')
        ->first();

        /////////////////////////////


        $currentDate = Carbon::now();
        $labels = [];
        // $maleData = [];
        // $femaleData = [];

        for ($i = 0; $i < 5; $i++) {
            $month = $currentDate->format('M');
            $labels[] = $month;


            $heartrateData[] = 70+$i;
 

            $currentDate->subMonth(); // Use subMonth() to move back in time
        }

        $timePeriod = $request->input('timePeriod');

        // Start with the DataPatient model
        $query = DataPatient::query();

        // Filter data based on the selected time period
        if ($timePeriod === 'today') {
            $query->whereDate('Date_created', now()->toDateString());

        } elseif ($timePeriod === 'week') {
            $query->whereBetween('Date_created', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($timePeriod === 'month') {
            $query->whereMonth('Date_created', now()->month);
        }

        // Select 'Date_created', 'bpm', 'spo2', and 'pi' columns
        $result = $query->select('Date_created', 'bpm', 'spo2', 'pi')->get();

        // Retrieve BPM data
        $datas = $result->pluck('bpm')->toJson();
        $dataspo2 = $result->pluck('spo2') -> toJson();
        $datapi = $result->pluck('pi') -> toJson();

        $datasy = $result->pluck('Date_created')->toJson();

        $resultpi = $query->whereDate('Date_created', now()->toDateString())
        ->pluck('pi')
        ->toJson();

        $resultspo2 = $query->whereDate('Date_created', now()->toDateString())
        ->pluck('spo2')
        ->toJson();

        $resultbpm = $query->whereDate('Date_created', now()->toDateString())
        ->pluck('bpm')
        ->toJson();

      

        // Reverse the order of the arrays
        $labels = array_reverse($labels);
        $heartrateData = array_reverse($heartrateData);

        /////////////////////////////


        return view('nurse.contents.patientProfile', compact('patientdetails','totaloperation','totalapt','doctors','appointments','listmedicines', 'labels', 'heartrateData', 'totalPastAppointments', 'medRecords', 'doctorNames', 'datas', 'dataspo2', 'datapi', 'resultpi', 'datasy', 'resultspo2', 'resultbpm'));
       
    }


    public function viewPatientMonitor()
    {
        $patients = Patient::all();

        // Calculate total patients
        $totalPatients = $patients->count();

        // Calculate average age of patients
        $totalAge = $patients->sum('age');
        $averageAge = $totalPatients > 0 ? $totalAge / $totalPatients : 0;

        // Calculate average gender
        $genderCounts = $patients->groupBy('gender')->map->count();
        $mostCommonGender = $genderCounts->sortDesc()->keys()->first();

        return view('nurse.contents.patientMonitor', compact('patients', 'totalPatients', 'averageAge', 'mostCommonGender'));
    }

    public function viewRoomList()
    {
        // Get the nurse information from the session
        $nurse = Nurse::where('email', Auth::user()->email)->first();

        $rooms = Room::all(); // Retrieve all rooms from the database

        // Retrieve deptid from the nurse model
        $deptId = $nurse->deptid;

        $doctors = Doctor::where('deptid', $deptId)->get();
        return view('nurse.contents.roomList', compact('rooms', 'doctors'));
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
        $deptId = $nurse->deptid; // Check if the nurse exists and then get the deptId

        //ikut department nurse
        $medrcs = MedRecord::with(['appointment' => function ($query) use ($deptId) {
            $query->where('deptid', '=', $deptId);
        }, 'patient', 'attendingDoctor', 'medInvoice'])
        ->get();    

        return view('nurse.contents.medrecordList', compact('medrcs'));
    }

    public function viewpaymentList() // by nurse department
    {
        // Retrieve the nurse based on the authenticated user's email
        $nurse = Nurse::where('email', Auth::user()->email)->first();
        $deptId = $nurse->deptid; // Check if the nurse exists and then get the deptId

        // ikut department nurse
        $medrcs = MedRecord::with(['appointment' => function ($query) use ($deptId) {
            $query->where('deptid', '=', $deptId);
        }, 'patient', 'attendingDoctor', 'medInvoice', 'medprescriptions'])
        ->get();

        return view('nurse.contents.paymentList', compact('medrcs'));
    }


    public function viewMedicalReport($medrc_id) // medrecord table id
    {
       
        $record = MedRecord::with('appointment', 'patient', 'attendingDoctor', 'medPrescription', 'medInvoice')
        ->where('refnum', $medrc_id)
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
        ->where('medrecord.id', $record->id)
        ->select('medprescription.*', 'medprescription.desc as med_desc')
        ->get();

        // upcoming appointment
        $nextApt = null; // Initialize the variable to avoid potential issues

        $nowApt = Appointments::find($record->aptid); // get current apt

        $nextApt = Appointments::where('appointment.patientid', $record->patientid)
                    ->where('appointment.docid', $nowApt->docid)
                    ->orderBy('date')
                    ->orderBy('time')
                    // next apt datetime > current apt datetime
                    ->where(function ($query) use ($nowApt) {
                        $query->where('date', '>', $nowApt->date)
                            ->orWhere(function ($query) use ($nowApt) {
                                $query->where('date', $nowApt->date)
                                    ->where('time', '>', $nowApt->time);
                            });
                    })
                    ->get();


        // ni dapatkan status next apt
        $nextAptStatus = []; // Initialize the array to store appointment status

        $currentDateTime = Carbon::now('Asia/Kuala_Lumpur'); // Current datetime in the specified timezone (e.g., Kuala Lumpur)

        foreach ($nextApt as $apt) {
            $aptDateTime = $apt->date . ' ' . $apt->time;
            $mrcDateTime = $record->date . ' ' . $record->time;

            if ($aptDateTime > $mrcDateTime) {
                $status = "";
                $badgeStyle = ''; // Initialize the badge style
                
                $done = MedRecord::where('aptid', $apt->id)->exists();
                $cancel = Appointments::where('status', 2)->where('id', $apt->id)->exists();
                
                // Calculate the datetime for the appointment
                $aptDateTimeCarbon = Carbon::parse($aptDateTime);
                
                // Check if the appointment datetime has already passed and no medrecord exists
                if ($aptDateTimeCarbon < $currentDateTime && !$done && !$cancel) {
                    $absent = Appointments::where('date', $apt->date) // apt that passed now datetime
                                ->where('time', $apt->time)
                                ->whereNotExists(function ($query) { // have no medrecord
                                    $query->select(DB::raw(1))
                                        ->from('medrecord')
                                        ->whereColumn('medrecord.aptid', 'appointment.id');
                                })
                                ->exists();
                    
                    if ($absent) {
                        $status = "Absent";
                        $badgeStyle = 'background-color: #DC2127; color: #ffffff; font-size: 13px; padding: 6px; font-weight: bold;';
                    }

                } elseif ($done) {
                    $status = "Done";
                    $badgeStyle = 'background-color: #51B749; color: #ffffff; font-size: 13px; padding: 6px;';

                } elseif ($cancel) {
                    $status = "Cancel";
                    $badgeStyle = 'background-color: #DC2127; color: #ffffff; font-size: 13px; padding: 6px;';

                } else {
                    $status = "Please take note";
                    $badgeStyle = 'background-color: #FFC107; font-size: 13px; padding: 6px;';
                }

                $nextAptStatus[] = [
                    'appointment' => $apt,
                    'status' => $status,
                    'badgeStyle' => $badgeStyle,
                ];
            }
        }// end upcoming appointment

        return view('nurse.contents.report', compact(
            'record','previousRecord','prevMedicine','medicines',
            //upcoming apt with status
            'nextAptStatus',));
    }

    public function viewAppointmentList()
    {
        $nurse = Nurse::where('email', Auth::user()->email)->first();

        // Add $currentDate variable here
        //$currentDate = Carbon::today()->toDateString();
        $currentDate = Carbon::now('Asia/Kuala_Lumpur')->toDateString();

        $startOfWeek = Carbon::now('Asia/Kuala_Lumpur')->startOfWeek();
        $endOfWeek = Carbon::now('Asia/Kuala_Lumpur')->endOfWeek();
    

        $doctorSchedule = DocSchedule::where('docid', 0)
        ->whereBetween('date', [$startOfWeek, $endOfWeek])
        ->pluck('date')
        ->toArray();

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

        return view('nurse.contents.appointmentList', compact('nurse', 'appointments', 'doctors', 'patients', 'departments', 'currentDate', 'doctorSchedule'));
    }

    public function viewAppointmentListDate(Request $request, $date)
    {
        // Convert the selected date to a Carbon instance for comparison
        $chooseDate = Carbon::parse($date);

        $nurse = Nurse::where('email', Auth::user()->email)->first();

        // Get the current date
        $currentDate = Carbon::now('Asia/Kuala_Lumpur')->toDateString();

        // Get the doctor's schedule for the current week
        $startOfWeek = Carbon::now('Asia/Kuala_Lumpur')->startOfWeek();
        $endOfWeek = Carbon::now('Asia/Kuala_Lumpur')->endOfWeek();

        $doctorSchedule = DocSchedule::where('docid', 0)
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

        // To join tables and retrieve the appointment list based on the nurse's department and selected date
        $appointments = Appointments::leftJoin('medrecord', 'medrecord.aptid', '=', 'appointment.id')
            ->join('patient', 'appointment.patientid', '=', 'patient.id')
            ->join('doctor', 'appointment.docid', '=', 'doctor.id')
            ->join('department', 'appointment.deptid', '=', 'department.id')
            ->select('appointment.*', 'patient.name as patient_name', 'patient.ic as patient_ic', 'doctor.name as doctor_name', 'department.name as dept_name', 'medrecord.status as medrecord_status')
            ->where('appointment.deptid', $nurse->deptid)
            ->whereDate('appointment.date', $chooseDate)
            ->orderBy('appointment.time', 'asc')
            ->get();

        $doctors = Doctor::where('doctor.deptid', $nurse->deptid)->get();
        $patients = Patient::all();
        $departments = Department::all();

        return view('nurse.contents.appointmentList', compact('nurse', 'appointments', 'doctors', 'patients', 'departments', 'currentDate', 'doctorSchedule', 'timeSlots', 'selectedDate'));
    }

    public function getDateSlots($selectedDoctor = 0)
    {
        $startOfWeek = Carbon::now('Asia/Kuala_Lumpur')->startOfWeek();
        $endOfWeek = Carbon::now('Asia/Kuala_Lumpur')->endOfWeek();
        // Assuming 'date' is the column name in your table
        
        $selectedDate = DocSchedule::where('docid', $selectedDoctor)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get();
    
        // $timeSlots = [];
    
        // Check if any time slots were found for the selected date
        if (! $selectedDate->isEmpty()) {
            // Loop through each time slot
            foreach ( $selectedDate as $dateSlot) {
                $dateSlots[]=$dateSlot->date;
                
            }
        } else {
            // If no time slots were found, you may want to handle this case accordingly
            // $dateSlots[] = 'No available date for the selected doctor';
            $dateSlots = [];
        }
    
        return response()->json($dateSlots);
    }

    
    public function getTimeSlots($selectedDoctor = 0, $selectedDate = '')
    {
        // Assuming 'date' is the column name in your table
        $selectedTime = DocSchedule::where('docid', $selectedDoctor)
            ->where('date', $selectedDate)
            ->select('starttime', 'endtime')
            ->get();
    
        $timeSlots = [];
    
        // Check if any time slots were found for the selected date
        if (!$selectedTime->isEmpty()) {
            // Loop through each time slot
            foreach ($selectedTime as $timeSlot) {
                $start = Carbon::parse($timeSlot->starttime);
                $end = Carbon::parse($timeSlot->endtime);
    
                // Reset the start time to the initial value
                $startCopy = $start->copy();
    
                // Create time slots in 30-minute intervals
                while ($startCopy < $end) {
                    $timeSlots[] = $startCopy->format('H:i') . ' - ' . $startCopy->addMinutes(30)->format('H:i');
                }
            }
        } else {
            // If no time slots were found, you may want to handle this case accordingly
            $timeSlots = [];
        }
    
        return response()->json($timeSlots);
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

    // Edit payment
    public function EditPayment(Request $request, $medrecordid)
    {
        $validatedData = $request->validate([
            'method' => 'required_if:action,payment', // Validate if action is payment
            'medstatus' => 'required_if:action,pickup', // Validate if action is pickup
        ]);

        $medinvoice = MedInvoice::where('medrecordid', $medrecordid)->first();

        if (!$medinvoice) {
            return redirect('/nurse/paymentList')->with('error', 'MedInvoice not found');
        }

        $action = $request->input('action');

        if ($action === 'payment') {
            $medinvoice->method = $request->input('method');
            $message = 'Payment has been made';
        } elseif ($action === 'pickup') {
            $medinvoice->medstatus = 1;
            $message = 'Patient successfully picked up.';
        } else {
            return redirect('/nurse/paymentList')->with('error', 'Invalid action');
        }

        $medinvoice->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $medinvoice->save();

        return redirect('/nurse/paymentList')->with('success', $message);
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
         // Check if a room with the same name already exists
        $existingRoom = Room::where('name', $request->name)->first();

        if ($existingRoom) {
            // Room with the same name already exists, display an alert or return an error message
            return redirect('/nurse/roomList')->with('error', 'Room is already occupied by other doctor.');
        }
     
        //insert data into room table
        $room = new Room();
        $room->name = $request->name;
        $room->type = $request->type;
        $room->desc = $request->desc;
        $room->staff_id = $request->docid;
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
        $room->staff_id = $request->input('docid');
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
         // Get the nurse information from the session
        $nurse = Nurse::where('email', Auth::user()->email)->first();

        // Get the input data
        $patientId = $request->patientid;
        $doctorId = $request->docid;
        $date = $request->date;

        // Retrieve deptid from the nurse model
        $deptId = $nurse->deptid;
    
        // Convert time from '2:00 PM - 2:30 PM' to 'H:i' format
    

        $timeRange = $request->time;
        $timeParts = explode(' - ', $timeRange);
        $startTime = date('Y-m-d H:i:s', strtotime($timeParts[0]));
        $endTime = date('Y-m-d H:i:s', strtotime($timeParts[1]));
    
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
                    ->where('time', '>=', $endTime);
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

            // Determine the starting point for queueid
            $startingQueueId = 1000;

            // Get the maximum existing queueid in the Attendance table
            $maxQueueId = Attendance::max('queueid');

            // If no records exist, set the initial value to 1000, otherwise increment the maximum value
            $attendance->queueid = $maxQueueId ? $maxQueueId + 1 : $startingQueueId;

            $attendance->save();
        }

        // Update the status in the appointments table as well
        $appointment->status = $status;
        $appointment->save();

        return redirect('/nurse/dashboard')->with('success', 'Successfully updated');
    }

    public function getBpmData(Request $request)
    {
        try {
            $timePeriod = $request->input('timePeriod');
    
            // Start with the DataPatient model
            $query = DataPatient::query();
    
            // Filter data based on the selected time period
            if ($timePeriod === 'today') {
                $query->whereDate('Date_created', now()->toDateString());
            } elseif ($timePeriod === 'week') {
                $query->whereBetween('Date_created', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($timePeriod === 'month') {
                $query->whereMonth('Date_created', now()->month);
            }
    
            // Select 'Date_created', 'bpm', and 'spo2' columns
            $result = $query->select('Date_created', 'bpm', 'spo2', 'pi')->get();
    
            return response()->json([
                'status' => 'success',
                'data' => $result,
            ]);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error',
            ], 500);
        }
    }

    public function getLatestData(Request $request)
      {
          try {
              // Start with the DataPatient model
              $query = DataPatient::query();
      
              // Select the latest record
              $latestRecord = $query->latest('Date_created')->first();
      
              // Check if any data was found
              if ($latestRecord) {                 
      
                  return response()->json([
                      'status' => 'success',
                      'data' => [
                          'latestBpm' => $latestRecord->bpm,
                          'latestSpo2' => $latestRecord->spo2,
                          'latestPi' => $latestRecord->pi,
                          'latestDate' => $latestRecord->Date_created,
                      ],
                  ]);
              } else {
                  // Handle the case where no data is found
                  return response()->json([
                      'status' => 'error',
                      'message' => 'No data available',
                  ]);
              }
          } catch (\Exception $e) {
              // Handle exceptions
              return response()->json([
                  'status' => 'error',
                  'message' => 'Internal Server Error',
              ], 500);
          }
      }



}

