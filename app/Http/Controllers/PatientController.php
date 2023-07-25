<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Department;
use App\Models\DocSchedule;
use App\Models\Medicine;
use App\Models\MedRecord;
use App\Models\Medprescription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    
    public function index()
    {

        $email=Auth()->user()->email;
        $name=Auth()->user()->name;

        $totalAppointments = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        ->select('appointment.*')
        ->where('patient.email', $email )
        ->count();

        $appointments = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        ->join('medrecord', 'appointment.id', '=', 'medrecord.aptid')
        ->select('appointment.*', 'patient.id as patient_id','patient.name as patient_name', 'doctor.name as doctor_name', 'medrecord.desc as descs')
        ->where('patient.email', $email )
        ->get();

        $listmedicines = Medicine::select('medicine.name')
        ->join('medprescription', 'medicine.id', '=', 'medprescription.medicineid')
        ->join('patient', 'patient.id', '=', 'medprescription.patientid')
        ->where('patient.email', '=', $email)
        ->distinct()
        ->get();

        $listDoctors = Doctor::select('doctor.*','department.name as dept_name')
        ->join('medrecord', 'doctor.id', '=', 'medrecord.docid')
        ->join('department', 'doctor.deptid', '=', 'department.id')
        ->join('patient', 'patient.id', '=', 'medrecord.patientid')
        ->where('patient.email', '=', $email)
        ->distinct()
        ->get();

        $detailpatients = Patient::where('email', $email)->get();


        return view('patient.contents.dashboard', compact('name','totalAppointments','appointments','listmedicines','detailpatients','listDoctors'));
    }

    public function viewAppointmentList()
    {

        // Get the currently authenticated user...
        // $user = Auth::user();

        // // Get the currently authenticated user's ID...
        // $id = Auth::email();
        $email=Auth()->user()->email; //dapatemail dr login

        $appointments = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        ->join('department', 'appointment.deptid', '=', 'department.id')
        ->select('appointment.*', 'patient.id as patient_id','patient.name as patient_name', 'doctor.name as doctor_name', 'department.name as dept_name')
        ->where('patient.email', $email )
        ->get();

        $doctors = Doctor::all();
        $patients = Patient::where('email', $email)->get();
        $departments = Department::all();

        return view('patient.contents.appointmentList', compact('appointments','doctors','patients','departments'));
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
        $user = Patient::find($id);
        
        $user->name = $request->input('name');
        $user->ic = $request->input('ic');
        $user->age = $request->input('age'); 
        $user->gender = $request->input('gender'); 
        $user->phoneno = $request->input('phoneno'); 
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->weight = $request->input('weight');
        $user->height = $request->input('height');
        $user->bloodtype = $request->input('bloodtype');
        $user->save();

        return redirect('/patient/profile')->with('success', 'Profile has been updated');
    }

    /////////////////////////////////Appointment//////////////////////////////////////////////////////////////////


    public function AddAppointment(Request $request)
    {
         // Get the currently logged-in doctor
         $patient = Patient::where('email', Auth::user()->email)->first();
    
         if (!$patient) {
             // Handle the case if the logged-in user is not a doctor
             // For example, redirect them to a different page or show an error message
             // You can also return an empty array of appointments if you prefer
         }
     
        //$patientId = $patient->id;

        // Get the input data
        $patientId = $patient->id;;
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

        //insert data into nurse table
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
        $appointment->status = 0;
        $appointment->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $appointment->save();

        return redirect('/patient/appointmentList')->with('success', 'New Appointment has been successfully added');
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

        return redirect('/patient/appointmentList')->with('success', 'Appointment has been updated');
    }

    public function deleteAppointment($id)
    {
        $appointment = Appointments::findOrFail($id);


        $appointment->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE appointment SET id = @counter:=@counter+1;');


        return redirect('/patient/appointmentList')->with('success', 'Appointment has been deleted');
    }
}