<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Doctor; 

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
        return view('nurse.contents.medicines');
    }

}

