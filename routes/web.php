<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//Admin
Route::get('/', function () {
    return view('/admin.index');
});

Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/doctorList', [AdminController::class, 'viewDoctorList']);
Route::get('/admin/nurseList', [AdminController::class, 'viewNurseList']);
Route::get('/admin/patientList', [AdminController::class, 'viewPatientList']);
Route::get('/admin/roomsList', [AdminController::class, 'viewRoomList']);
Route::get('/admin/appointmentList', [AdminController::class, 'viewAppointmentList']);

//Doctor
Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard']);
Route::get('/doctor/patientList', [DoctorController::class, 'viewPatientList']);
Route::get('/doctor/appointmentList', [DoctorController::class, 'viewAppointmentList']);
Route::get('/doctor/medicines', [DoctorController::class, 'viewMedicineList']);
Route::get('/doctor/reports', [DoctorController::class, 'viewReportList']);

//Nurse
Route::get('/nurse/dashboard', function () {
    return view('nurse.index');
});
Route::get('/nurse/dashboard', [NurseController::class, 'index']);
Route::get('/nurse/doctorList', [NurseController::class, 'viewDoctorList']);
Route::get('/nurse/patientList', [NurseController::class, 'viewPatientList']);
Route::get('/nurse/roomList', [NurseController::class, 'viewRoomList']);
Route::get('/nurse/appointmentList', [NurseController::class, 'viewAppointmentList']);
Route::get('/nurse/medicineList', [NurseController::class, 'viewMedicineList']);

//Patient
Route::get('/Patient/dashboard', function () {
    return view('Patient.index');
});
Route::get('/Patient/dashboard', [PatientController::class, 'index']);
Route::get('/Patient/appointmentList', [PatientController::class, 'viewAppointmentList']);
Route::get('/Patient/reportList', [PatientController::class, 'viewMedicineList']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
