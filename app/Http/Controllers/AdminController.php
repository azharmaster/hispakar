<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.contents.dashboard');
    }

    public function viewDoctorList()
    {
        $doctors = Doctor::all();
        $departments = Department::all();

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

        return view('admin.contents.patientList', compact('patients'));
    }

    public function viewRoomList()
    {
        return view('admin.contents.roomsList');
    }

    public function viewAppointmentList()
    {
        return view('admin.contents.appointmentList');
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
        $user->staff_id = $request->staff_id;
        $user->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $user->save();

        //insert data into doctor table
        $doctor = new Doctor();
        $doctor->staff_id = $request->staff_id;
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
        $doctor->gender = $request->input('gender');
        $doctor->dob = $request->input('dob');
        $doctor->email = $request->input('email');
        $doctor->phoneno = $request->input('phoneno');
        $doctor->specialization = $request->input('specialization');
        $doctor->deptid = $request->input('deptid');  
        
        $doctor->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $doctor->save();

        // Update the corresponding user record
        $user = User::where('staff_id', $doctor->staff_id)->first();
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
        $staffId = $doctor->staff_id;

        $doctor->delete();
        
        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE doctor SET id = @counter:=@counter+1;');
       
        // Delete the corresponding user record
        User::where('staff_id', $staffId)->delete();
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
        $user->staff_id = $request->staff_id;
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
        $nurse->name = $request->input('name');
        $nurse->gender = $request->input('gender');
        $nurse->dob = $request->input('dob');
        $nurse->email = $request->input('email');  
        $nurse->phoneno = $request->input('phoneno');
        $nurse->deptid = $request->input('deptid');
        
        $nurse->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $nurse->save();

         // Update the corresponding user record
         $user = User::where('staff_id', $nurse->staff_id)->first();
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
        $staffId = $nurse->staff_id;

        $nurse->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE nurse SET id = @counter:=@counter+1;');

        // Delete the corresponding user record
        User::where('staff_id', $staffId)->delete();

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
        $user->staff_id = $request->ic;
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
        $patient->address = $request->input('address'); 
        $patient->weight = $request->input('weight');  
        $patient->height = $request->input('height'); 
        $patient->bloodtype = $request->input('bloodtype'); 
        $patient->email = $request->input('email'); 
        $patient->updated_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

        $patient->save();

        // Update the corresponding user record
        $user = User::where('staff_id', $patient->ic)->first();
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
        $staffId = $patient->ic;

        $patient->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE patient SET id = @counter:=@counter+1;');

        // Delete the corresponding user record
        User::where('staff_id', $staffId)->delete();

        return redirect('/admin/patientList')->with('success', 'Patient has been deleted');
    }


}
