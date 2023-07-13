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

Route::get('/', function () {
    return view('auth.login');
});

//Admin
// Route::get('/', function () {
//     return view('/admin.index');
// });
Auth::routes();

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin', 'auth']], function(){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.contents.dashboard');
    Route::get('/doctorList', [AdminController::class, 'viewDoctorList']);
    Route::get('/nurseList', [AdminController::class, 'viewNurseList']);
    Route::get('/patientList', [AdminController::class, 'viewPatientList']);
    Route::get('/roomsList', [AdminController::class, 'viewRoomList']);
    Route::get('/appointmentList', [AdminController::class, 'viewAppointmentList']);

});


//Doctor
Route::group(['prefix'=>'doctor', 'middleware'=>['isDoctor', 'auth']], function(){
    Route::get('/dashboard', [DoctorController::class, 'index'])->name('doctor.contents.dashboard');
    Route::get('/patientList', [DoctorController::class, 'viewPatientList']);
    Route::get('/appointmentList', [DoctorController::class, 'viewAppointmentList']);
    Route::get('/medicines', [DoctorController::class, 'viewMedicineList']);
    Route::get('/reports', [DoctorController::class, 'viewReportList']);
});

//Nurse
// Route::get('/nurse/dashboard', function () {
//     return view('nurse.index');
// });
Route::group(['prefix'=>'nurse', 'middleware'=>['isNurse', 'auth']], function(){
    Route::get('/dashboard', [NurseController::class, 'index'])->name('nurse.contents.dashboard');
    Route::get('/doctorList', [NurseController::class, 'viewDoctorList']);
    Route::get('/patientList', [NurseController::class, 'viewPatientList']);
    Route::get('/roomsList', [NurseController::class, 'viewRoomList']);
    Route::get('/appointmentList', [NurseController::class, 'viewAppointmentList']);
    Route::get('/medicineList', [NurseController::class, 'viewMedicineList']);
});

//Patient
// Route::get('/Patient/dashboard', function () {
//     return view('Patient.index');
// });
Route::group(['prefix'=>'patient', 'middleware'=>['isPatient', 'auth']], function(){
    Route::get('/dashboard', [PatientController::class, 'index'])->name('patient.contents.dashboard');
    Route::get('/appointmentList', [PatientController::class, 'viewAppointmentList']);
    Route::get('/reportList', [PatientController::class, 'viewMedicineList']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('patient.contents.dashboard');
