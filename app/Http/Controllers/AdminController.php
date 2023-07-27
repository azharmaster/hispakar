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
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        $medicines = Medicine::all();

        $nurses = Nurse::join('department', 'nurse.deptid', '=', 'department.id')
        ->select('nurse.*', 'department.name as dept_name')
        ->get();
        

        return view('admin.contents.dashboard', compact('totalapt','totaldoc','totalroom','totaldept',
        'totalnurse','totalpatient','totalmedicine','medicines','nurses','totalapt2','totaldoc2',
        'totalnurse2','totalpatient2','totalroom2','totaldept2','totalmedicine2'));
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

        // $doctordetails = Doctor::where('id', $id)->get();
        $doctordetails = Doctor::join('department', 'doctor.deptid', '=', 'department.id')
        ->join('users', 'doctor.email', '=', 'users.email')
        ->select('doctor.*', 'department.name as dept_name', 'users.image as image')
        ->where('doctor.id', $id)
        ->get();

        $totaloperation = MedRecord::where('docid', $id)
        ->distinct('patientid')
        ->count('patientid');

        $totalrecord = MedRecord::where('docid', $id)
        ->count('id');

        $totalapt = Appointments::where('docid', $id)
        ->where('status', 1)
        ->count('id');

        return view('admin.contents.doctorProfile', compact('doctordetails','totaloperation','totalrecord','totalapt'));
       
    }

    public function viewPatientProfile($id) //profile doctor
    {

        $patientdetails = Patient::where('id', $id)->get();

        $totaloperation = MedRecord::where('patientid', $id)
        ->count('patientid');

        $totalapt = Appointments::where('patientid', $id)
        ->where('status', 1)
        ->count('id');

        $doctors = MedRecord::where('patientid', $id)
        ->select(DB::raw('(SELECT name FROM doctor WHERE id = docid) as doctor'))
        ->distinct()
        ->get();


        return view('admin.contents.patientProfile', compact('patientdetails','totaloperation','totalapt','doctors'));
       
    }

    public function viewDepartmentList()
    {
        $departments = Department::all();

        return view('admin.contents.departmentList', compact('departments'));
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

    public function viewRoomList()
    {
        $rooms = Room::all();

        return view('admin.contents.roomList', compact('rooms'));
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
        

        return view('admin.contents.appointmentList', compact('appointments','doctors','patients','departments'));
    }

    public function viewMedicineList()
    {
        $medicines = Medicine::all();

        return view('admin.contents.medicineList', compact('medicines'));
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
        $appointment->status = $request->input('status');
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
                    $request->file('image')->storeAs('admin/profilePic', $filename, 'public');
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

}
