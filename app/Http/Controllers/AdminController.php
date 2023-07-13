<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.contents.dashboard');
    }

    public function viewDoctorList()
    {
        return view('admin.contents.doctorList');
    }

    public function viewNurseList()
    {
        return view('admin.contents.nurseList');
    }

    public function viewPatientList()
    {
        return view('admin.contents.patientList');
    }

    public function viewRoomList()
    {
        return view('admin.contents.roomsList');
    }

    public function viewAppointmentList()
    {
        return view('admin.contents.appointmentList');
    }

}
