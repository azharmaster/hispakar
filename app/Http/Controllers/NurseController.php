<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Doctor; 
use App\Models\Medicine; 

class NurseController extends Controller
{
    public function index()
    {
        return view('nurse.index');
    }

    public function viewDoctorList()
    {
        $doctors = Doctor::all(); // Retrieve all doctors from the database

        return view('nurse.contents.doctorList', compact('doctors'));
    }

    public function viewPatientList()
    {
        return view('nurse.contents.patientList');
    }

    public function viewRoomList()
    {
        return view('nurse.contents.roomsList');
    }

    public function viewAppointmentList()
    {
        return view('nurse.contents.appointmentList');
    }

    public function viewMedicineList()
    {
        $medicines = Medicine::all(); // Retrieve all medicines from the database

        return view('nurse.contents.medicineList', compact('medicines'));
    }

    // Manage medicine functions in nurse
    // Add medicine
    public function AddMedicine(Request $request)
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
    public function DeleteMedicine($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();
        
        DB::statement('SET @counter = 0;');
        DB::statement('UPDATE medicine SET id = @counter:=@counter+1;');

        return redirect('/nurse/medicineList')->with('success', 'Medicine has been deleted');
    }
    // End manage medicine
    


}

