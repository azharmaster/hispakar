<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        return view('patient.index');
    }

    public function viewAppointmentList()
    {
        return view('patient.contents.appointmentList');
    }

    public function viewReportList()
    {
        return view('patient.contents.reportList');
    }
}