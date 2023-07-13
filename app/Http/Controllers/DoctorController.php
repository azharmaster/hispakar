<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return view('doctor.contents.dashboard');
    }

    public function viewPatientList()
    {
        return view('doctor.contents.patientList');
    }

    public function viewAppointmentList()
    {
        return view('doctor.contents.appointmentList');
    }

    public function viewMedicineList()
    {
        return view('doctor.contents.medicines');
    }

    public function viewReportList()
    {
        return view('doctor.contents.reports');
    }

   
}
