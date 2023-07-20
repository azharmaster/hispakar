<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\MedPrescription;
use App\Models\MedRecord;
use App\Models\MedService;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
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
        ->join('doctor', 'appointment.docid', '=', 'doctor.id')
        ->join('department', 'appointment.deptid', '=', 'department.id')
        ->select('appointment.*', 'patient.name as patient_name', 'doctor.name as doctor_name', 'department.name as dept_name')
        ->get();

        $patients = Patient::all();
        $doctors = Doctor::all();
        $departments = Department::all();

        return view('doctor.contents.appointmentList', compact('appointments', 'patients', 'doctors','departments'));
    }

    public function viewAppointmentReport($id)
    {
        $appointment = Appointments::with(['patient', 'medrecord'])
            ->where('id', $id)
            ->first();

            if (!$appointment->patient || !$appointment->medrecord) {
                $appointment = Appointments::join('patient', 'appointment.patientid', '=', 'patient.id')
                    ->join('medrecord', 'appointment.id', '=', 'medrecord.aptid')
                    ->select('appointment.*', 'patient.*', 'medrecord.*')
                    ->where('appointment.id', $id)
                    ->first();
            }

        $singlePatient = $appointment->patient;
        $medservices = MedService::all();
        $patients = Patient::all(); // Add this line to fetch all patients

        $medicines = Medicine::all();

        return view('doctor.contents.appointmentReport', compact('appointment', 'medicines', 'singlePatient', 'medservices', 'patients'));
    }

    public function viewMedicineList()
    {
        $medicines = Medicine::all();

        return view('doctor.contents.medicines', compact('medicines'));
    }

    public function viewReportList()
    {
        $reports = MedRecord::join('patient', 'medrecord.patientid', '=', 'patient.id')
                    ->select('medrecord.*', 'patient.*')
                    ->get();
                    
        return view('doctor.contents.reports', compact('reports'));
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
        $patient->age = $request->age;
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

    //Manage Appointment
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

        return redirect('/doctor/appointmentList')->with('success', 'New Appointment has been successfully added');
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

        return redirect('/doctor/appointmentList')->with('success', 'Appointment has been updated');
    }

    public function deleteAppointment($id)
    {
        $appointment = Appointments::findOrFail($id);

        $appointment->delete();

        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE appointment SET id = @counter:=@counter+1;');

        return redirect('/doctor/appointmentList')->with('success', 'Appointment has been deleted');
    }

    //Manage medicine
    public function AddMedicine(Request $request) // Add medicine
    {
        //create new medicine record
        $medicine = new Medicine();
        $medicine->name = $request->input('name');
        $medicine->stock = $request->input('stock');
        $medicine->price = $request->input('price');
        $medicine->desc = $request->input('desc');
        $medicine->save();

        return redirect('/doctor/medicines')->with('success', 'New medicine has been successfully added');
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

        return redirect('/doctor/medicines')->with('success', 'Medicine details has been updated');
    }

    // Delete medicine
    public function DeleteMedicine($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        
        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE medicine SET id = @counter:=@counter+1;');

        return redirect('/doctor/medicines')->with('success', 'Medicine has been deleted');
    }
   
    //Appointment record
    public function AddAppointmentRecord(Request $request, $id)
    {
        // Insert data into medrecord table
        $medRec = new MedRecord();
        $medRec->aptid = $id;
        $medRec->serviceid = $request->input('serviceid');
        $medRec->desc = $request->input('desc')['med_record'];
        $medRec->datetime = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $medRec->patientid = $request->input('patientid');
        $medRec->docid = Auth::id();
        $medRec->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
        $medRec->save();

        //Med Prescription
       // Get the selected medicine values from the request
        $selectedMedicines = $request->input('medicines')['id'] ?? [];
        $quantities = Arr::wrap($request->input('qty'));
        $descriptions = Arr::wrap($request->input('desc')['med_prescription']);

        // Validate if all arrays have the same length
        if (count($selectedMedicines) === count($quantities) && count($selectedMedicines) === count($descriptions)) {
            $count = count($selectedMedicines);

            // Loop through each selected medicine
            for ($i = 0; $i < $count; $i++) {
                // Split the medicine into ID and name directly from the array
                list($medicineId, $medicineName) = explode(':', $selectedMedicines[$i]);

                // Validate if the required data is not empty before saving
                if (!empty($medicineId) && !empty($medicineName) && !empty($quantities[$i]) && !empty($descriptions[$i])) {
                    // Insert data into medprescription table
                    $medPres = new MedPrescription();
                    $medPres->aptid = $id;
                    $medPres->medicineid = $medicineId;
                    $medPres->name = $medicineName;
                    $medPres->qty = $quantities[$i];
                    $medPres->desc = $descriptions[$i];
                    $medPres->docid = Auth::id();
                    $medPres->patientid = $request->input('patientid');
                    $medPres->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');
                    $medPres->save();
                } else {
                    // Handle the case when required data is missing or empty
                    // You can log an error or add a validation error message here
                    // depending on your application's requirements.
                    // For example, you can log an error message:
                    // Log::error("Incomplete data for medicine entry $i");
                    // Or add a validation error message to be displayed to the user:
                    // return redirect()->back()->withErrors(['error' => "Incomplete data for medicine entry $i"]);
                }
            }
        } else {
            // Handle the case when arrays have different lengths
            // You can log an error or add a validation error message here
            // depending on your application's requirements.
            // For example, you can log an error message:
            // Log::error("Mismatched array lengths for selected medicines, quantities, and descriptions");
            // Or add a validation error message to be displayed to the user:
            // return redirect()->back()->withErrors(['error' => "Mismatched array lengths for selected medicines, quantities, and descriptions"]);
        }


        // Check if the checkbox is checked
        if ($request->has('scheduleNext')) {
            // Checkbox is checked, so insert the data into the database
            $apt = new Appointments();
            $apt->patientid = $request->input('patientid');
            $apt->docid = Auth::id();
            $apt->created_at = Carbon::now('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s');

            // Check if the date and time inputs are provided
            if ($request->has('date')) {
                $apt->date = $request->input('date');
            }

            if ($request->has('time')) {
                $apt->time = $request->input('time');
            }

            $apt->save();
        }

        return redirect('/doctor/appointmentList')->with('success', 'Successfully inserted');
    }

}
