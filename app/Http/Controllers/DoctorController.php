<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        return view('doctor.contents.dashboard');
    }

    public function viewPatientList()
    {
        $patients = Patient::all();

        return view('doctor.contents.patientList', compact('patients'));
    }

    public function viewAppointmentList()
    {
        //to join table
        $appointments = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        ->join('medrecord', 'appointment.id', '=', 'medrecord.aptid')
        ->select('appointment.*', 'patient.name as patient_name', 'patient.ic as patient_ic', 'medrecord.*')
        ->get();

        return view('doctor.contents.appointmentList', compact('appointments'));
    }

    public function viewMedicineList()
    {
        return view('doctor.contents.medicines');
    }

    public function viewReportList()
    {
        return view('doctor.contents.reports');
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

   
}
