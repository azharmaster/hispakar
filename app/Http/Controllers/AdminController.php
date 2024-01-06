<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Department;
use App\Models\Admin;
use App\Models\DocSchedule;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\Room;
use App\Models\User;
use App\Models\Medicine;
use App\Models\MedRecord;
use App\Models\MedService;
use App\Models\MedPrescription;
use App\Models\MedInvoice;
use App\Models\bpm;
use App\Models\spo2;
use App\Models\pi;
use App\Models\fuzzyres;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index() //dashboard
    {
        $firstDay = Carbon::now()->startOfMonth();
        $now = Carbon::now();

        $totalapt = Appointments::all()->count();
        $totalapt2 = Appointments::whereBetween('created_at', [$firstDay, $now])->count();

        $totaldoc = Doctor::all()->count();
        $totaldoc2 = Doctor::whereBetween('created_at', [$firstDay, $now])->count();

        $totalnurse = Nurse::all()->count();
        $totalnurse2 = Nurse::whereBetween('created_at', [$firstDay, $now])->count();

        $totalpatient = Patient::all()->count();
        $totalpatient2 = Patient::whereBetween('created_at', [$firstDay, $now])->count();

        $totalroom = Room::all()->count();
        $totalroom2 = Room::whereBetween('created_at', [$firstDay, $now])->count();

        $totaldept = Department::all()->count();
        $totaldept2 = Department::whereBetween('created_at', [$firstDay, $now])->count();

        $totalmedicine = Medicine::all()->count();
        $totalmedicine2 = Medicine::whereBetween('created_at', [$firstDay, $now])->count();

        $totalservice = MedService::all()->count();
        $totalservice2 = MedService::whereBetween('created_at', [$firstDay, $now])->count();

        $newborns = Patient::where('age', '<=', 1)->count(); // Assuming newborns are age 1 or below
        $infants = Patient::whereBetween('age', [2, 5])->count(); // Assuming infants are between ages 2 and 5
        $children = Patient::whereBetween('age', [6, 12])->count(); // Assuming children are between ages 6 and 12
        $adolescents = Patient::whereBetween('age', [13, 18])->count(); // Assuming adolescents are between ages 13 and 18
        $oldAge = Patient::where('age', '>=', 60)->count(); // Assuming old age starts from age 60
        

        $medicines = Medicine::all();

        $doctors = Doctor::join('department', 'doctor.deptid', '=', 'department.id')
        ->select('doctor.*', 'department.name as dept_name')
        ->get();

        $today = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d'); // Today's date

        foreach ($doctors as $doctor) { //total appointment
            // $doctor->available = DocSchedule::where('docid', $doctor->id)
            // ->where('date', $today)
            // ->selectRaw('CONCAT(date, " ", starttime) AS combined_datetime')
            // ->get();

            $doctor->available = DocSchedule::where('docid', $doctor->id)
            ->where('date', $today)
            ->select(DB::raw('CONCAT(date, " ", starttime) AS combined_datetime'))
            ->whereRaw('CURTIME() BETWEEN starttime AND endtime')
            ->count();
        }

        $nurses = Nurse::join('department', 'nurse.deptid', '=', 'department.id')
        ->select('nurse.*', 'department.name as dept_name')
        ->get();

        // calendar for admin - display all appointment - not by department
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
                    ->whereExists(function ($query) { // have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                    $totalCancel = DB::table('appointment') // total cancel
                    ->where('date', $cDate)
                    ->whereNotExists(function ($query) { // not have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                } else { // today / next apt 

                    $totalDone = DB::table('appointment') // total done
                    ->where('date', $cDate)
                    ->whereExists(function ($query) { // have medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();   
                    
                    $totalAttend = DB::table('appointment')
                    ->where('date', $cDate)
                    ->where('status', 1) // status attend
                    ->whereNotExists(function ($query) { // not medrecord
                        $query->select(DB::raw(1))
                            ->from('medrecord')
                            ->whereColumn('medrecord.aptid', 'appointment.id');
                    })->count();

                    $totalCancel = DB::table('appointment')
                    ->where('date', $cDate)
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
                        'url' => route('admin.appointmentList', ['date' => $cDate]),
                        'backgroundColor' => $event['color'],
                        'borderColor' => $event['borderColor'],
                        'allDay' => true,
                    ];
                }
            }
        } // End calendar

        ///////////////////////////////////////////////////////////

        // $currentDate = Carbon::now();
        // $labels = [];

        // for ($i = 0; $i < 5; $i++) {
        //     $labels[] = $currentDate->format('M');
        //     $currentDate->subMonth(); // Use subMonth() to move back in time
        // }

        
        // // Reverse the order of the array
        //  $labels = array_reverse($labels);

        
        // // $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June'];
        // //$maleData = [5, 4, 5, 4, 5, 4];
        // $femaleData = [5, 1, 6, 4, 2, 7];

  

        $currentDate = Carbon::now();
        $labels = [];
        $maleData = [];
        $femaleData = [];

        for ($i = 0; $i < 5; $i++) {
            $month = $currentDate->format('M');
            $labels[] = $month;

            $maleCount = Patient::where('gender', 'male')
                ->whereYear('created_at', $currentDate->year)
                ->whereMonth('created_at', $currentDate->month)
                ->count();

            $femaleCount = Patient::where('gender', 'female')
                ->whereYear('created_at', $currentDate->year)
                ->whereMonth('created_at', $currentDate->month)
                ->count();

            $maleData[] = $maleCount;
            $femaleData[] = $femaleCount;

            $currentDate->subMonth(); // Use subMonth() to move back in time
        }

        // Reverse the order of the arrays
        $labels = array_reverse($labels);
        $maleData = array_reverse($maleData);
        $femaleData = array_reverse($femaleData);

        // print_r($labels);
        // print_r($maleData);
        // print_r($femaleData);

        

        return view('admin.contents.dashboard', compact('totalapt','totaldoc','totalroom','totaldept',
        'totalnurse','totalpatient','totalmedicine','medicines','nurses','doctors','totalapt2','totaldoc2',
        'totalnurse2','totalpatient2','totalroom2','totaldept2','totalmedicine2', 'totalservice', 'totalservice2',
        'newborns','infants','children','adolescents','oldAge',
        //calendar
        'calendarEvents', 'labels', 'maleData', 'femaleData'));
    }

    public function getLiveData()
    {
        // Fetch data from the 'bpm' table
        $bpmData = Bpm::select('id', 'Value', 'Date_created')
            ->orderBy('Date_created', 'desc')
            ->limit(20)
            ->get();

        // Fetch data from the 'spo2' table
        $spo2Data = Spo2::select('id', 'Value', 'Date_created')
            ->orderBy('Date_created', 'desc')
            ->limit(20)
            ->get();

        // Fetch data from the 'pi' table
        $piData = Pi::select('id', 'Value', 'Date_created')
            ->orderBy('Date_created', 'desc')
            ->limit(20)
            ->get();

        return response()->json(['bpm' => $bpmData, 'spo2' => $spo2Data, 'pi' => $piData]);
    }

    public function viewProfile() //profile admin
    {
        $email=Auth()->user()->email; //dapatemail dr login
        $name=Auth()->user()->name;

        $admindetails = Admin::where('email', $email)->get();

        return view('admin.contents.profile', compact('admindetails','name'));
       
    }

    public function viewDoctorProfile($id) //profile doctor
    {
        // Get the current date
        //$today = Carbon::today();
        $today = Carbon::now('Asia/Kuala_Lumpur')->toDateString();
        // Get the current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // $doctordetails = Doctor::where('id', $id)->get();
        $doctordetails = Doctor::join('department', 'doctor.deptid', '=', 'department.id')
        ->join('users', 'doctor.email', '=', 'users.email')
        ->select('doctor.*', 'department.name as dept_name', 'users.image as image')
        ->where('doctor.id', $id)
        ->get();

        //total patient card and modal
        $totalPatientIds = MedRecord::where('docid', $id)
            ->distinct('patientid')
            ->pluck('patientid'); // This will give an array of distinct patient IDs
        $totalpatient = count($totalPatientIds); // Count the number of distinct patient IDs
        $totalpatientdetails = Patient::whereIn('id', $totalPatientIds)->get(); // get patient details

        //total apt today card and modal
        $totalapttodaydetails = Appointments::where('docid', $id)
        ->where('status', 1)
        ->whereDate('date', $today)
        ->orderBy('time', 'desc')
        ->with('patient')
        ->get();
        $totalapttoday = $totalapttodaydetails->count();

        //total medical record card and modal
        $totalrecorddetails = MedRecord::where('docid', $id)
        ->orderBy('datetime', 'desc')
        ->with('patient')// get patient details
        ->get();

        $totalrecord = $totalrecorddetails->count();

        //for today's medical record card
        $todayMedRecs = MedRecord::join('patient', 'medrecord.patientid', '=', 'patient.id')
        ->where('medrecord.docid', $id)
        ->whereDate('medrecord.datetime', $today)
        ->orderBy('medrecord.datetime', 'desc')
        ->get();

        //total next apt card and modal
        $totalnextaptdetails = Appointments::where('docid', $id)
        ->where('status', 1)
        ->where('appointment.date', '>', $today) // Add the condition to check if the appointment date is after today
        ->orderBy('date', 'asc')
        ->orderBy('time', 'asc')
        ->with('patient')// get patient details
        ->whereNotIn('id', function ($query) {
            $query->select('aptid')
                ->from('medrecord');
        })
        ->get();
        $totalnextapt = $totalnextaptdetails->count();

        //chart
        $totalmale = MedRecord::select(DB::raw('COUNT(DISTINCT patient.id) as total_male'))
        ->join('patient', 'medrecord.patientid', '=', 'patient.id')
        ->where('medrecord.docid', $id)
        ->where('patient.gender', 'male')
        ->count();

        $totalfemale = MedRecord::select(DB::raw('COUNT(DISTINCT patient.id) as total_female'))
        ->join('patient', 'medrecord.patientid', '=', 'patient.id')
        ->where('medrecord.docid', $id)
        ->where('patient.gender', 'female')
        ->count();

        //chart for Age
        $ageGroups = MedRecord::select(
            DB::raw('SUM(CASE WHEN age <= 12 THEN 1 ELSE 0 END) as children'),
            DB::raw('SUM(CASE WHEN age BETWEEN 13 AND 19 THEN 1 ELSE 0 END) as teenage'),
            DB::raw('SUM(CASE WHEN age BETWEEN 20 AND 64 THEN 1 ELSE 0 END) as adult'),
            DB::raw('SUM(CASE WHEN age >= 65 THEN 1 ELSE 0 END) as older')
        )
        ->join('patient', 'medrecord.patientid', '=', 'patient.id')
        ->where('medrecord.docid', $id)
        ->first();

        $children = $ageGroups->children;
        $teenage = $ageGroups->teenage;
        $adult = $ageGroups->adult;
        $older = $ageGroups->older;

        //chart attendance statistic
        $totalattend = [];
        $totalcancel = [];

        // Loop through the past five months and get the attendance and cancellation data
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

            // Get the total attendance count for the current month
            $totalattend[] = MedRecord::where('docid', $id)
                ->whereBetween('datetime', [$startDate, $endDate])
                ->count();

            // Get the total cancellation count for the current month
            $totalcancel[] = Appointments::where('appointment.docid', $id)
                ->leftJoin('medrecord', 'appointment.id', '=', 'medrecord.aptid')
                ->whereNull('medrecord.aptid')
                ->whereMonth('appointment.date', $month)
                ->whereYear('appointment.date', $year)
                ->count();
        }

        return view('admin.contents.doctorProfile', compact(
            'doctordetails',
            'totalpatient','totalapttoday','totalrecord','totalnextapt', //card
            'totalpatientdetails','totalapttodaydetails','totalrecorddetails','totalnextaptdetails', 'todayMedRecs', //card modal
            'totalmale', 'totalfemale', // gender chart
            'totalattend', 'totalcancel', // attendance chart
            'children', 'teenage', 'adult', 'older', // ages chart
        ));
       
    }

    public function viewNurseProfile($id)
    {

        $nurse = Nurse::findOrFail($id);
        $deptid = $nurse->deptid;

        // Get the current date
        $today = Carbon::now('Asia/Kuala_Lumpur')->toDateString();
        // Get the current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $nursedetails = Nurse::join('department', 'nurse.deptid', '=', 'department.id')
        ->join('users', 'nurse.email', '=', 'users.email')
        ->select('nurse.*', 'department.name as dept_name', 'users.image as image')
        ->where('nurse.id', $id)
        ->get();

        // Total patient under nurse department 
        $totalpatient = MedPrescription::where('nurseid', $id)
        ->join('medrecord', 'medrecord.id', '=', 'medprescription.aptid')
        ->join('patient', 'patient.id', '=', 'medrecord.patientid')
        ->count('patient.id');

        //repair this query
        $totalpatientdetails = MedPrescription::where('nurseid', $id)
        ->join('medrecord', 'medrecord.id', '=', 'medprescription.aptid')
        ->join('patient', 'patient.id', '=', 'medrecord.patientid')
        ->with('patient')
        ->get();

        //total apt today card and modal
        $totalapttodaydetails = Appointments::where('deptid', $deptid)
        ->where('status', 1)
        ->whereDate('date', $today)
        ->orderBy('time', 'desc')
        ->with('patient')
        ->get();
        $totalapttoday = $totalapttodaydetails->count();

        //total medical record card and modal
        $totalrecorddetails = MedRecord::join('appointment', 'medrecord.aptid', '=', 'appointment.id')
        ->where('appointment.deptid', $deptid)
        ->orderBy('datetime', 'desc')
        ->with('patient')// get patient details
        ->get();

        $totalrecord = $totalrecorddetails->count();

        //for today's med record card
        $todayMedRecs = MedRecord::join('appointment', 'medrecord.aptid', '=', 'appointment.id')
        ->where('appointment.deptid', $deptid)
        ->whereDate('medrecord.datetime', $today)
        ->orderBy('medrecord.datetime', 'desc')
        ->with('patient')// get patient details
        ->get();

        //total next apt card and modal
        $totalnextaptdetails = Appointments::where('deptid', $deptid)
        ->where('status', 1)
        ->where('appointment.date', '>', $today) // Add the condition to check if the appointment date is after today
        ->orderBy('date', 'asc')
        ->orderBy('time', 'asc')
        ->with('patient')// get patient details
        ->whereNotIn('id', function ($query) {
            $query->select('aptid')
                ->from('medrecord');
        })
        ->get();
        $totalnextapt = $totalnextaptdetails->count();

        //chart for Age
        $ageGroups = MedRecord::select(
            DB::raw('SUM(CASE WHEN age <= 12 THEN 1 ELSE 0 END) as children'),
            DB::raw('SUM(CASE WHEN age BETWEEN 13 AND 19 THEN 1 ELSE 0 END) as teenage'),
            DB::raw('SUM(CASE WHEN age BETWEEN 20 AND 64 THEN 1 ELSE 0 END) as adult'),
            DB::raw('SUM(CASE WHEN age >= 65 THEN 1 ELSE 0 END) as older')
        )
        ->join('appointment', 'medrecord.aptid', '=', 'appointment.id')
        ->where('appointment.deptid', $deptid)
        ->join('patient', 'medrecord.patientid', '=', 'patient.id')
        ->first();

        $children = $ageGroups->children;
        $teenage = $ageGroups->teenage;
        $adult = $ageGroups->adult;
        $older = $ageGroups->older;

        //chart attendance statistic
        $totalattend = [];
        $totalcancel = [];

        // Loop through the past five months and get the attendance and cancellation data
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

            // Get the total attendance count for the current month
            $totalattend[] = MedRecord::join('appointment', 'medrecord.aptid', '=', 'appointment.id')
                ->where('appointment.deptid', $deptid)
                ->whereBetween('datetime', [$startDate, $endDate])
                ->count();

            // Get the total cancellation count for the current month
            $totalcancel[] = Appointments::where('appointment.deptid', $deptid)
                ->leftJoin('medrecord', 'appointment.id', '=', 'medrecord.aptid')
                ->whereNull('medrecord.aptid')
                ->whereMonth('appointment.date', $month)
                ->whereYear('appointment.date', $year)
                ->count();
        }

        return view('admin.contents.nurseProfile', compact(
            'nursedetails',
            'totalpatient', 'totalapttoday','totalrecord','totalnextapt', //card
            'totalpatientdetails','totalapttodaydetails','totalrecorddetails','totalnextaptdetails', 'todayMedRecs', //card modal
            'totalattend', 'totalcancel', // attendance chart
            'children', 'teenage', 'adult', 'older', // ages chart
        ));
       
    }

    public function viewPatientProfile($id) //profile doctor
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
        ->select('appointment.*', 'patient.id as patient_id','patient.name as patient_name', 'doctor.name as doctor_name', 'medrecord.desc as descs')
        ->where('patient.id', $id )
        ->get();

        $totalPastAppointments = MedRecord::join('appointment', 'medrecord.aptid', '=', 'appointment.id')
        ->leftJoin('attendance', 'appointment.id', '=', 'attendance.aptid')
        ->where('appointment.patientid', $id)
        ->whereDate('appointment.date', '<', now()) // Filter past appointments based on the current date
        ->count('appointment.id');

         // Get unique doctor names from the collection
         $doctorNames = $appointments->pluck('doctor_name')->unique();

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

      

        // Reverse the order of the arrays
        $labels = array_reverse($labels);
        $heartrateData = array_reverse($heartrateData);

        /////////////////////////////


        return view('admin.contents.patientProfile', compact('patientdetails','totaloperation','totalapt','doctors','appointments','listmedicines', 'labels', 'heartrateData', 'totalPastAppointments', 'medRecords', 'doctorNames'));
       
    }

    public function viewDepartmentList()
    {
        $departments = Department::all();

        return view('admin.contents.departmentList', compact('departments'));
    }

    public function viewServiceList()
    {
        $services = MedService::all();

        return view('admin.contents.serviceList', compact('services'));
    }

    public function viewDoctorList()
    {
        $doctors = Doctor::join('department', 'doctor.deptid', '=', 'department.id')
        ->select('doctor.*', 'department.name as dept_name')
        ->get();


        $departments = Department::all();

        // foreach ($doctors as $doctor) { //total patient
        //     $doctor->record_count = MedRecord::where('docid', $doctor->id)->count();
        // }

        // foreach ($doctors as $doctor) { //total operation
        //     $doctor->operation_count = MedRecord::where('docid', $doctor->id)->count();
        // }

        // foreach ($doctors as $doctor) { //total appointment
        //     $doctor->appointment_count = Appointments::where('docid', $doctor->id)->count();
        // }
        

        return view('admin.contents.doctorList', compact('doctors', 'departments'));
    }

 

    public function viewNurseList()
    {
        $nurses = Nurse::all();
        $departments = Department::all();

        return view('admin.contents.nurseList', compact('nurses', 'departments'));
    }

    public function viewPatientList()
    {
        $patients = Patient::all();

        // foreach ($patients as $patient) { //total appointment
        //     $patient->appointment_count = Appointments::where('docid', $patient->id)->count();
        // }
        
        foreach ($patients as $patient) { //total appointment
            $patient->appointment_count = Appointments::where('patientid', $patient->id)->count();
        }

        return view('admin.contents.patientList', compact('patients'));
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

        return view('admin.contents.patientMonitor', compact('patients', 'totalPatients', 'averageAge', 'mostCommonGender'));
    }

    public function viewRoomList()
    {
        $rooms = Room::all();

        return view('admin.contents.roomList', compact('rooms'));
    }

    public function viewAppointmentList()
    {
        $currentDate = Carbon::now('Asia/Kuala_Lumpur')->toDateString();

        $appointments = Appointments::leftJoin('medrecord', 'medrecord.aptid', '=', 'appointment.id')
                    ->join('patient', 'appointment.patientid', '=', 'patient.id')
                    ->join('doctor', 'appointment.docid', '=', 'doctor.id')
                    ->join('department', 'appointment.deptid', '=', 'department.id')
                    ->select('appointment.*', 'patient.name as patient_name', 'doctor.name as doctor_name', 'department.name as dept_name',
                    'medrecord.id as medrc_id', 'medrecord.status as medrecord_status')
                    ->get();

        $doctors = Doctor::all();
        $patients = Patient::all();
        $departments = Department::all();
        

        return view('admin.contents.appointmentList', compact('appointments','doctors','patients','departments', 'currentDate'));
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
        return view('admin.contents.appointmentList', [
            'appointments' => $filteredAppointments,
            'doctors' => $viewData['doctors'],
            'patients' => $viewData['patients'],
            'departments' => $viewData['departments'],
            'selectedDate' => $selectedDate,
        ]);
    }

    public function viewMedicineList()
    {
        $medicines = Medicine::all();

        return view('admin.contents.medicineList', compact('medicines'));
    }


    public function viewMedRecord()
    {
        $medrcs = MedRecord::with('appointment', 'patient', 'attendingDoctor', 'medInvoice')->get();
        
        return view('admin.contents.medrecord', compact('medrcs'));
    }

    public function viewReport($medrc_id) // medrecord table id
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

        return view('admin.contents.report', compact(
            'record','previousRecord','prevMedicine','medicines','nextAptStatus',));
    }

    // Manage Doctor
    public function AddDoctor(Request $request)
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

        //insert data into doctor table
        $doctor = new Doctor();
        // $doctor->staff_id = $request->staff_id;
        $doctor->ic = $request->ic;
        $doctor->name = $request->name;
        $doctor->gender = $request->gender;
        $doctor->dob = $request->dob;
        $doctor->email = $request->email;
        $doctor->password = Hash::make($request->password);
        $doctor->phoneno = $request->phoneno;
        $doctor->specialization = $request->specialization;
        $doctor->deptid = $request->deptid;
        $doctor->usertype = $request->usertype;
        $doctor->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $doctor->save();

        return redirect('/admin/doctorList')->with('success', 'New doctor has been successfully added');
    }

    public function EditDoctor(Request $request, $id)
    {
        $doctor = Doctor::find($id);
        $doctor->name = $request->input('name');
        $doctor->ic = $request->input('ic');
        $doctor->gender = $request->input('gender');
        $doctor->dob = $request->input('dob');
        $doctor->email = $request->input('email');
        $doctor->phoneno = $request->input('phoneno');
        $doctor->specialization = $request->input('specialization');
        $doctor->deptid = $request->input('deptid');  
        
        $doctor->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $doctor->save();

        // Update the corresponding user record
        $user = User::where('ic', $doctor->ic)->first();
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
            $user->save();
        }

        return redirect('/admin/doctorList')->with('success', 'Doctor has been updated');
    }

    public function deleteDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $ic = $doctor->ic;

        $doctor->delete();
        
        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE doctor SET id = @counter:=@counter+1;');
       
        // Delete the corresponding user record
        User::where('ic', $ic)->delete();
        //return back()->with('success', 'Doctor has been successfully deleted');

        return redirect('/admin/doctorList')->with('success', 'Doctor has been deleted');
    }

    //Manage Nurse
    public function AddNurse(Request $request)
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
        $nurse = new Nurse();
        $nurse->staff_id = $request->staff_id;
        $nurse->ic = $request->ic;
        $nurse->name = $request->name;
        $nurse->gender = $request->gender;
        $nurse->dob = $request->dob;
        $nurse->email = $request->email;
        $nurse->password = Hash::make($request->password);
        $nurse->phoneno = $request->phoneno;
        $nurse->deptid = $request->deptid;
        $nurse->usertype = $request->usertype;
        $nurse->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $nurse->save();

        return redirect('/admin/nurseList')->with('success', 'New nurse has been successfully added');
    }

    public function EditNurse(Request $request, $id)
    {
        $nurse = Nurse::find($id);
        $nurse->staff_id = $request->input('staff_id');
        $nurse->ic = $request->input('ic');
        $nurse->name = $request->input('name');
        $nurse->gender = $request->input('gender');
        $nurse->dob = $request->input('dob');
        $nurse->email = $request->input('email');  
        $nurse->phoneno = $request->input('phoneno');
        $nurse->deptid = $request->input('deptid');
        
        $nurse->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $nurse->save();

         // Update the corresponding user record
         $user = User::where('ic', $nurse->ic)->first();
         if ($user) {
             $user->name = $request->input('name');
             $user->email = $request->input('email');
             $user->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
             $user->save();
         }

        return redirect('/admin/nurseList')->with('success', 'Nurse has been updated');
    }

    public function deleteNurse($id)
    {
        $nurse = Nurse::findOrFail($id);
        $ic = $nurse->ic;

        $nurse->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE nurse SET id = @counter:=@counter+1;');

        // Delete the corresponding user record
        User::where('ic', $ic)->delete();

        return redirect('/admin/nurseList')->with('success', 'Nurse has been deleted');
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
        $patient->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $patient->save();

        return redirect('/admin/patientList')->with('success', 'New patient has been successfully added');
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

        return redirect('/admin/patientList')->with('success', 'Patient has been updated');
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

        return redirect('/admin/patientList')->with('success', 'Patient has been deleted');
    }



    /////////////////////////////////ROOM//////////////////////////////////////////////////////////////////

    public function AddRooms(Request $request)
    {
     
        //insert data into nurse table
        $room = new Room();
        $room->name = $request->name;
        $room->type = $request->type;
        $room->desc = $request->desc;
        $room->staff_id = $request->staff_id;
        $room->status = $request->status;
        $room->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $room->save();

        return redirect('/admin/roomList')->with('success', 'New Rooms has been successfully added');
    }

    public function EditRooms(Request $request, $id)
    {
        $room = Room::find($id);
        
        $room->name = $request->input('name');
        $room->type = $request->input('type');
        $room->desc = $request->input('desc'); 
        $room->status = $request->input('status');
        $room->staff_id = $request->input('staff_id');
        $room->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $room->save();

        return redirect('/admin/roomList')->with('success', 'Room has been updated');
    }

    public function deleteRooms($id)
    {
        $room = Room::findOrFail($id);


        $room->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE room SET id = @counter:=@counter+1;');


        return redirect('/admin/roomList')->with('success', 'Room has been deleted');
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
        // $startTime = $request->input('startTime');
        // $endTime = $request->input('endTime');
    
        // // Check if the selected time slot is booked
        // $isBooked = Appointments::where('date', $selectedDate)
        //     ->where('time', '>=', $startTime)
        //     ->where('time', '<', $endTime)
        //     ->exists();

        $selectedTime=DocSchedule::where('date', $selectedDate)
            ->select('starttime','endtime')
            ->get();

            foreach ($selectedTime as $timeSlot) {
                $start = Carbon::parse($timeSlot->starttime);
                $end = Carbon::parse($timeSlot->endtime);
                
                // Now $startTimeFormatted and $endTimeFormatted contain the formatted times 'H:i'
                // You can use these variables as needed.
            }


            while ($start < $end) {
                $isBooked[] = $start->format('H:i') . ' - ' . $start->addMinutes(30)->format('H:i');
            }
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
    
        return redirect('/admin/appointmentList')->with('success', 'New Appointment has been successfully added');
    }

    public function EditAppointment(Request $request, $id)
    {
        $appointment = Appointments::find($id);
        
        $appointment->patientid = $request->input('patientid');
        $appointment->docid = $request->input('docid');
        $appointment->deptid = $request->input('deptid'); 
        $appointment->date = $request->input('date'); 
        $appointment->time = $request->input('time'); 
        // $appointment->status = $request->input('status');
        $appointment->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $appointment->save();

        return redirect('/admin/appointmentList')->with('success', 'Appointment has been updated');
    }

    
    public function deleteAppointment($id)
    {
        $appointment = Appointments::findOrFail($id);


        $appointment->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE appointment SET id = @counter:=@counter+1;');


        return redirect('/admin/appointmentList')->with('success', 'Appointment has been deleted');
    }

      /////////////////////////////////DEPARTMENT//////////////////////////////////////////////////////////////////

      public function AddDepartment(Request $request)
      {
       
          //insert data into nurse table
          $dept = new Department();
          $dept->name = $request->name;
          $dept->desc = $request->desc;
          $dept->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
          $dept->save();
  
          return redirect('/admin/departmentList')->with('success', 'New department has been successfully added');
      }
  
      public function EditDepartment(Request $request, $id)
      {
          $dept = Department::find($id);
          
          $dept->name = $request->input('name');
          $dept->desc = $request->input('desc'); 
          $dept->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
          $dept->save();
  
          return redirect('/admin/departmentList')->with('success', 'Department has been updated');
      }
  
      public function deleteDepartment($id)
      {
          $dept = Department::findOrFail($id);
  
  
          $dept->delete();
  
          DB::statement('SET @counter = 0;');
          DB::statement('UPDATE department SET id = @counter:=@counter+1;');
  
  
          return redirect('/admin/departmentList')->with('success', 'Department has been deleted');
      }


        /////////////////////////////////MEDICINE//////////////////////////////////////////////////////////////////

        public function AddMedicine(Request $request)
        {
         
            //insert data into nurse table
            $medicine = new Medicine();
            $medicine->name = $request->name;
            $medicine->price = $request->price;
            $medicine->desc = $request->desc;
            $medicine->stock = $request->stock;
            $medicine->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
            $medicine->save();
    
            return redirect('/admin/medicineList')->with('success', 'New Medicine has been successfully added');
        }
    
        public function EditMedicine(Request $request, $id)
        {
            $medicine = Medicine::find($id);
            
            $medicine->name = $request->input('name');
            $medicine->price = $request->input('price');
            $medicine->desc = $request->input('desc');
            $medicine->stock = $request->input('stock'); 
            $medicine->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
            $medicine->save();
    
            return redirect('/admin/medicineList')->with('success', 'Medicine has been updated');
        }
    
        public function deleteMedicine($id)
        {
            $medicine = Medicine::findOrFail($id);
    
    
            $medicine->delete();
    
            DB::statement('SET @counter = 0;');
            DB::statement('UPDATE medicine SET id = @counter:=@counter+1;');
    
    
            return redirect('/admin/medicineList')->with('success', 'Medicine has been deleted');
        }

        public function EditProfile(Request $request, $id)
        {
            $admin = Admin::find($id);

            // Update the corresponding user record
            $user = User::where('email', $admin->email)->first();
            
            // If the user record exists and the email is not changed or the new email is unique
            if ($user && ($request->input('email') === $admin->email || User::where('email', $request->input('email'))->doesntExist())) {
                
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
                    $admin->name = $request->input('name');
                    $admin->phoneno = $request->input('phoneno');
                    $admin->email = $request->input('email');
                    $admin->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
    
                    $admin->save();
    
                    DB::commit();
                    
                    return redirect('/admin/profile')->with('success', 'Your profile has been updated');
                } catch (\Exception $e) {
                    DB::rollBack();
                    
                    return redirect()->back()->with('success', 'ERROR! Unable to updating your profile.');
                }
            } else {
                return redirect()->back()->with('success', 'Unsuccessful, the email already exists.');
            }
        }


              /////////////////////////////////SERVICE//////////////////////////////////////////////////////////////////

      public function AddServices(Request $request)
      {
       
          //insert data into nurse table
          $service = new MedService();
          $service->type = $request->type;
          $service->desc = $request->desc;
          $service->charge = $request->charge;
          $service->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
          $service->save();
  
          return redirect('/admin/serviceList')->with('success', 'New service has been successfully added');
      }
  
      public function EditServices(Request $request, $id)
      {
          $service = MedService::find($id);
          
          $service->type = $request->input('type');
          $service->desc = $request->input('desc'); 
          $service->charge = $request->input('charge'); 
          $service->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
          $service->save();
  
          return redirect('/admin/serviceList')->with('success', 'Service has been updated');
      }
  
      public function deleteServices($id)
      {
          $service = MedService::findOrFail($id);
  
  
          $service->delete();
  
          DB::statement('SET @counter = 0;');
          DB::statement('UPDATE medservice SET id = @counter:=@counter+1;');
  
  
          return redirect('/admin/serviceList')->with('success', 'Service has been deleted');
      }





}
