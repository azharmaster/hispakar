<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $medicines = Medicine::all(); // Retrieve all doctors from the database

        return view('nurse.contents.medicineList', compact('medicines'));
    }

    public function AddMedicine(Request $request)
    {
        //create new medicine record
        $medicine = new Medicine();
        $medicine->name = $request->input('name');
        $medicine->stock = $request->input('stock');
        $medicine->price = $request->input('price');
        $medicine->desc = $request->input('desc');
        $medicine->save();

        return redirect('/nurse/medicineList')->with('success', 'Successfully added');
    }
    


}

