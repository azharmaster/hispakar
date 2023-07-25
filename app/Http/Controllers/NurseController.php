<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Patient; 
use App\Models\Doctor;
use App\Models\Nurse; 
use App\Models\Profile;  
use App\Models\Medicine; 
use App\Models\Room; 
use App\Models\Department; 
use App\Models\Appointments;

class NurseController extends Controller
{
    public function index()
    {
        $totalapt = Appointments::all()->count();
        $totaldoc = Doctor::all()->count();
        $totalnurse = Doctor::all()->count();
        $totalpatient = Patient::all()->count();
        $totalroom = Room::all()->count();
        $totaldept = Department::all()->count();
        $totalmedicine = Medicine::all()->count();

        $patients = Patient::all();
        $medicines = Medicine::all();
        $rooms = Room::all();
        $doctors = Doctor::all();

        return view('nurse.contents.dashboard', compact('totalpatient', 'medicines', 'totalroom', 'totaldoc'));
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

    public function viewAppointmentList()
    {

        $appointments = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
        ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        ->join('department', 'appointment.deptid', '=', 'department.id')
        ->select('appointment.*', 'patient.name as patient_name', 'doctor.name as doctor_name', 'department.name as dept_name')
        ->get();

        $doctors = Doctor::all();
        $patients = Patient::all();
        $departments = Department::all();

        return view('nurse.contents.appointmentList', compact('appointments','doctors','patients','departments'));
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
        $room->status = $request->status;
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


    public function AddAppointment(Request $request)
    {
     
        //insert data into nurse table
        $appointment = new Appointments();
        $appointment->patientid = $request->patientid;
        $appointment->docid = $request->docid;
        $appointment->deptid = $request->deptid;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->status = $request->status;
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



}

