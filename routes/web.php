<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
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
//Auth::routes();


//Doctor
Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard']);
Route::get('/doctor/patientList', [DoctorController::class, 'viewPatientList']);
Route::get('/doctor/appointmentList', [DoctorController::class, 'viewAppointmentList']);
Route::get('/doctor/medicines', [DoctorController::class, 'viewMedicineList']);
Route::get('/doctor/reports', [DoctorController::class, 'viewReportList']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
