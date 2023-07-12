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
        return view('admin.contents.doctorList');
    }

    public function viewPatientList()
    {
        return view('admin.contents.patientList');
    }

    public function viewRoomList()
    {
        return view('admin.contents.roomList');
    }

    public function viewAppointmentList()
    {
        return view('admin.contents.appointmentList');
    }

    public function viewMedicineList()
    {
        return view('admin.contents.medicineList');
    }

}

