<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.contents.dashboard');
    }

    public function viewDoctorList()
    {
        $doctors = Doctor::all();

        return view('admin.contents.doctorList', compact('doctors'));
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
