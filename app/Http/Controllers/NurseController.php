<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NurseController extends Controller
{
    public function index()
    {
        return view('nurse.index');
    }

    public function viewDoctorList()
    {
        return view('nurse.contents.doctorList');
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
        return view('nurse.contents.medicineList');
    }

}

