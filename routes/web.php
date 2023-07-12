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

Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::get('/doctorList', [AdminController::class, 'viewDoctorList']);
Route::get('/nurseList', [AdminController::class, 'viewNurseList']);
Route::get('/patientList', [AdminController::class, 'viewPatientList']);
Route::get('/roomsList', [AdminController::class, 'viewRoomList']);
Route::get('/appointmentList', [AdminController::class, 'viewAppointmentList']);
//Auth::routes();


//Doctor
Route::get('/dashboard', [DoctorController::class, 'dashboard']);
Route::get('/patientList', [DoctorController::class, 'viewPatientList']);
Route::get('/appointmentList', [DoctorController::class, 'viewAppointmentList']);
Route::get('/medicines', [DoctorController::class, 'viewMedicineList']);
Route::get('/reports', [DoctorController::class, 'viewReportList']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
