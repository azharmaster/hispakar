<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        return view('patient.index');
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

    

    public function viewReportList()
    {
        return view('patient.contents.reportList');
    }


    /////////////////////////////////Appointment//////////////////////////////////////////////////////////////////


    public function AddAppointment(Request $request)
    {
     
        //insert data into nurse table
        $appointment = new Appointments();
        $appointment->patientid = $request->patientid;
        $appointment->docid = $request->docid;
        $appointment->deptid = $request->deptid;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->status = 0;
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