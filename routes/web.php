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

Route::group(['middleware'=>['isAdmin', 'auth']], function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.contents.dashboard');
    Route::get('/admin/doctorList', [AdminController::class, 'viewDoctorList']);
    Route::get('/admin/nurseList', [AdminController::class, 'viewNurseList']);
    Route::get('/admin/patientList', [AdminController::class, 'viewPatientList']);
    Route::get('/admin/roomsList', [AdminController::class, 'viewRoomList']);
    Route::get('/admin/appointmentList', [AdminController::class, 'viewAppointmentList']);

    //Manage Doctor
    Route::post('/admin/doctorList', [AdminController::class, 'AddDoctor']);
    Route::post('/admin/doctorList/{id}', [AdminController::class, 'EditDoctor']);
    Route::delete('/admin/doctorList/{id}', [AdminController::class, 'deleteDoctor'])->name('deleteDoctor');

    //Manage Nurse
    Route::post('/admin/nurseList', [AdminController::class, 'AddNurse']);
    Route::post('/admin/nurseList/{id}', [AdminController::class, 'EditNurse']);
    Route::delete('/admin/nurseList/{id}', [AdminController::class, 'deleteNurse'])->name('deleteNurse');

    //Manage Patient
    Route::post('/admin/patientList', [AdminController::class, 'AddPatient']);
    Route::post('/admin/patientList/{id}', [AdminController::class, 'EditPatient']);
    Route::delete('/admin/patientList/{id}', [AdminController::class, 'deletePatient'])->name('deletePatient');


    //Manage Room
    Route::post('/admin/roomsList', [AdminController::class, 'AddRooms']);
    Route::post('/admin/roomsList/{id}', [AdminController::class, 'EditRooms']);
    Route::delete('/admin/roomsList/{id}', [AdminController::class, 'deleteRooms'])->name('deleteRooms');
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
Route::group(['middleware'=>['isNurse', 'auth']], function(){
    Route::get('/nurse/dashboard', [NurseController::class, 'index'])->name('nurse.contents.dashboard');
    Route::get('/nurse/doctorList', [NurseController::class, 'viewDoctorList']);
    Route::get('/nurse/patientList', [NurseController::class, 'viewPatientList']);
    Route::get('/nurse/roomsList', [NurseController::class, 'viewRoomList']);
    Route::get('/nurse/appointmentList', [NurseController::class, 'viewAppointmentList']);
    Route::get('/nurse/medicineList', [NurseController::class, 'viewMedicineList']);

    //Manage medicine in nurse
    Route::post('/nurse/medicineList', [NurseController::class, 'AddMedicine']);
    Route::post('/nurse/medicineList/{id}', [NurseController::class, 'EditMedicine']);
    Route::delete('/nurse/medicineList/{id}', [NurseController::class, 'DeleteMedicine'])->name('DeleteMedicine');
});

//Patient
Route::group(['prefix'=>'patient', 'middleware'=>['isPatient', 'auth']], function(){
    Route::get('/dashboard', [PatientController::class, 'index'])->name('patient.contents.dashboard');
    Route::get('/appointmentList', [PatientController::class, 'viewAppointmentList']);
    Route::get('/reportList', [PatientController::class, 'viewMedicineList']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('patient.contents.dashboard');
