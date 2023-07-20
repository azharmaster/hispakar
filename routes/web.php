<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\NurseController;
use App\Http\Controllers\PatientController;
use App\Models\Patient;
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
    Route::get('/admin/roomList', [AdminController::class, 'viewRoomList']);
    Route::get('/admin/appointmentList', [AdminController::class, 'viewAppointmentList']);
    Route::get('/admin/departmentList', [AdminController::class, 'viewDepartmentList']);

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
    Route::post('/admin/roomList', [AdminController::class, 'AddRooms']);
    Route::post('/admin/roomList/{id}', [AdminController::class, 'EditRooms']);
    Route::delete('/admin/roomList/{id}', [AdminController::class, 'deleteRooms'])->name('deleteRooms');

     //Manage Appoiment
     Route::post('/admin/appointmentList', [AdminController::class, 'AddAppointment']);
     Route::post('/admin/appointmentList/{id}', [AdminController::class, 'EditAppointment']);
     Route::delete('/admin/appointmentList/{id}', [AdminController::class, 'deleteAppointment'])->name('deleteAppointment');

    //Manage Department
    Route::post('/admin/departmentList', [AdminController::class, 'AddDepartment']);
    Route::post('/admin/departmentList/{id}', [AdminController::class, 'EditDepartment']);
    Route::delete('/admin/departmentList/{id}', [AdminController::class, 'deleteDepartment'])->name('deleteDepartment'); 
});


//Doctor
Route::group(['middleware'=>['isDoctor', 'auth']], function(){
    Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.contents.dashboard');
    Route::get('/doctor/patientList', [DoctorController::class, 'viewPatientList']);
    Route::get('/doctor/appointmentList', [DoctorController::class, 'viewAppointmentList']);
    Route::get('/doctor/appointmentReport/{id}', [DoctorController::class, 'viewAppointmentReport']);
    Route::get('/doctor/medicines', [DoctorController::class, 'viewMedicineList']);
    Route::get('/doctor/reports', [DoctorController::class, 'viewReportList']);

    //Manage Patient
    Route::post('/doctor/patientList', [DoctorController::class, 'AddPatient']);
    Route::post('/doctor/patientList/{id}', [DoctorController::class, 'EditPatient']);
    Route::delete('/doctor/patientList/{id}', [DoctorController::class, 'deletePatient'])->name('deletePatient');

    //Manage Appointment
    Route::post('/doctor/appointmentList', [DoctorController::class, 'AddAppointment']);
    Route::post('/doctor/appointmentList/{id}', [DoctorController::class, 'EditAppointment']);
    Route::delete('/doctor/appointmentList/{id}', [DoctorController::class, 'deleteAppointment'])->name('deleteAppointment');

    //Manage medicine
    Route::post('/doctor/medicines', [DoctorController::class, 'AddMedicine']);
    Route::post('/doctor/medicines/{id}', [DoctorController::class, 'EditMedicine']);
    Route::delete('/doctor/medicines/{id}', [DoctorController::class, 'DeleteMedicine'])->name('DeleteMedicine');

    //appointment record
    Route::post('/doctor/appointmentReport/{id}', [DoctorController::class, 'AddAppointmentRecord'])->name('doctor.addAppointmentRecord');


});

//Nurse
Route::group(['middleware'=>['isNurse', 'auth']], function(){
    //Manage page in nurse
    Route::get('/nurse/dashboard', [NurseController::class, 'index'])->name('nurse.contents.dashboard');
    Route::get('/nurse/profile', [NurseController::class, 'viewProfile'])->name('nurse.contents.profile');
    Route::get('/nurse/doctorList', [NurseController::class, 'viewDoctorList']);
    Route::get('/nurse/patientList', [NurseController::class, 'viewPatientList']);
    Route::get('/nurse/roomList', [NurseController::class, 'viewRoomList']);
    Route::get('/nurse/appointmentList', [NurseController::class, 'viewAppointmentList']);
    Route::get('/nurse/medicineList', [NurseController::class, 'viewMedicineList']);

    //Manage patient in nurse
    Route::post('/nurse/patientList', [NurseController::class, 'AddPatient']);
    Route::post('/nurse/patientList/{id}', [NurseController::class, 'EditPatient']);
    Route::delete('/nurse/patientList/{id}', [NurseController::class, 'deletePatient'])->name('deletePatient');

    //Manage room in nurse
    Route::post('/nurse/roomList', [NurseController::class, 'AddRoom']);
    Route::post('/nurse/roomList/{id}', [NurseController::class, 'EditRoom']);
    Route::delete('/nurse/roomList/{id}', [NurseController::class, 'deleteRoom'])->name('deleteRoom');

    //Manage medicine in nurse
    Route::post('/nurse/medicineList', [NurseController::class, 'AddMedicine']);
    Route::post('/nurse/medicineList/{id}', [NurseController::class, 'EditMedicine']);
    Route::delete('/nurse/medicineList/{id}', [NurseController::class, 'deleteMedicine'])->name('deleteMedicine');

    //Manage Appoitment in nurse
    Route::post('/nurse/appointmentList', [NurseController::class, 'AddAppointment']);
    Route::post('/nurse/appointmentList/{id}', [NurseController::class, 'EditAppointment']);
    Route::delete('/nurse/appointmentList/{id}', [NurseController::class, 'deleteAppointment'])->name('deleteAppointment');

});

    //Patient
    Route::group(['middleware'=>['isPatient', 'auth']], function(){
    Route::get('patient/dashboard', [PatientController::class, 'index'])->name('patient.contents.dashboard');
    Route::get('patient/appointmentList', [PatientController::class, 'viewAppointmentList']);
    Route::get('patient/reportList', [PatientController::class, 'viewReportList']);

    //Manage Appoiment
    Route::post('/patient/appointmentList', [PatientController::class, 'AddAppointment']);
    Route::post('/patient/appointmentList/{id}', [PatientController::class, 'EditAppointment']);
    Route::delete('/patient/appointmentList/{id}', [PatientController::class, 'deleteAppointment'])->name('deleteAppointment');
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('patient.contents.dashboard');
