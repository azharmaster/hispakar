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
Auth::routes();

Route::group(['middleware'=>['isAdmin', 'auth']], function(){
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.contents.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'viewProfile'])->name('admin.contents.profile');
    Route::get('/admin/doctorList', [AdminController::class, 'viewDoctorList']);
    Route::get('/admin/nurseList', [AdminController::class, 'viewNurseList']);
    Route::get('/admin/patientList', [AdminController::class, 'viewPatientList']);
    Route::get('/admin/roomList', [AdminController::class, 'viewRoomList']);
    Route::get('/admin/appointmentList', [AdminController::class, 'viewAppointmentList']);
    Route::get('/admin/departmentList', [AdminController::class, 'viewDepartmentList']);
    Route::get('/admin/medicineList', [AdminController::class, 'viewMedicineList']);
    Route::get('/admin/serviceList', [AdminController::class, 'viewServiceList']);
    Route::get('/admin/doctorProfile/{id}', [AdminController::class, 'viewDoctorProfile']);
    Route::get('/admin/nurseProfile/{id}', [AdminController::class, 'viewNurseProfile']);
    Route::get('/admin/patientProfile/{id}', [AdminController::class, 'viewPatientProfile']);
    Route::get('/admin/medrecord', [AdminController::class, 'viewMedRecord']);
    Route::get('/admin/appointmentList/{date}', [AdminController::class, 'viewAppointmentListDate'])->name('admin.appointmentList');

    //Report
    Route::get('/admin/report/{medrc_id}', [AdminController::class, 'viewReport']);

    //Manage profile
    Route::post('/admin/profile/{id}', [AdminController::class, 'EditProfile']);

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
     Route::get('/admin/getDoctorSchedule/{doctorId}', [AdminController::class, 'getDoctorSchedule']);
     Route::post('/admin/check-availability', 'AdminController@checkAvailability');
     Route::get('/admin/getBookedAppointmentTimes/{date}', [AdminController::class, 'getBookedAppointmentTimes']);
     Route::post('/admin/isTimeBooked', [AdminController::class, 'isTimeBooked']);


    //Manage Department
    Route::post('/admin/departmentList', [AdminController::class, 'AddDepartment']);
    Route::post('/admin/departmentList/{id}', [AdminController::class, 'EditDepartment']);
    Route::delete('/admin/departmentList/{id}', [AdminController::class, 'deleteDepartment'])->name('deleteDepartment'); 

    //Manage Medicine
    Route::post('/admin/medicineList', [AdminController::class, 'AddMedicine']);
    Route::post('/admin/medicineList/{id}', [AdminController::class, 'EditMedicine']);
    Route::delete('/admin/medicineList/{id}', [AdminController::class, 'deleteMedicine'])->name('deleteMedicine'); 

    //Manage Services
    Route::post('/admin/serviceList', [AdminController::class, 'AddServices']);
    Route::post('/admin/serviceList/{id}', [AdminController::class, 'EditServices']);
    Route::delete('/admin/serviceList/{id}', [AdminController::class, 'deleteServices'])->name('deleteServices');
});


//Doctor
Route::group(['middleware'=>['isDoctor', 'auth']], function(){
    Route::get('/doctor/dashboard', [DoctorController::class, 'index'])->name('doctor.contents.dashboard');
    Route::get('/doctor/profile', [DoctorController::class, 'viewProfile'])->name('doctor.contents.profile');
    Route::get('/doctor/patientList', [DoctorController::class, 'viewPatientList']);
    Route::get('/doctor/appointmentList', [DoctorController::class, 'viewAppointmentList']);
    Route::get('/doctor/appointmentReport/{id}', [DoctorController::class, 'viewAppointmentReport']);
    Route::get('/doctor/eappointmentReport/{id}', [DoctorController::class, 'viewEAppointmentReport']);
    Route::get('/doctor/medicineList', [DoctorController::class, 'viewMedicineList']);
    Route::get('/doctor/reports', [DoctorController::class, 'viewReportList']);
    Route::get('/doctor/scheduleList', [DoctorController::class, 'viewSchedule']);
    Route::get('/doctor/appointmentList/{date}', [DoctorController::class, 'viewAppointmentListDate'])->name('doctor.appointmentList');

    //Manage profile
    Route::post('/doctor/profile/{id}', [DoctorController::class, 'EditProfile']);

    //Manage Patient
    Route::post('/doctor/patientList', [DoctorController::class, 'AddPatient']);
    Route::post('/doctor/patientList/{id}', [DoctorController::class, 'EditPatient']);
    Route::delete('/doctor/patientList/{id}', [DoctorController::class, 'deletePatient'])->name('deletePatient');

    //Manage Appointment
    Route::post('/doctor/appointmentList', [DoctorController::class, 'AddAppointment']);
    Route::post('/doctor/appointmentList/{id}', [DoctorController::class, 'EditAppointment']);
    Route::delete('/doctor/appointmentList/{id}', [DoctorController::class, 'deleteAppointment'])->name('deleteAppointment');
    Route::get('/doctor/getDoctorSchedule/{doctorId}', [DoctorController::class, 'getDoctorSchedule']);
    Route::get('/doctor/get-time-slots', [DoctorAppointmentController::class, 'getTimeSlots']);

    //Manage medicine
    Route::post('/doctor/medicineList', [DoctorController::class, 'AddMedicine']);
    Route::post('/doctor/medicineList/{id}', [DoctorController::class, 'EditMedicine']);
    Route::delete('/doctor/medicineList/{id}', [DoctorController::class, 'DeleteMedicine'])->name('DeleteMedicine');

    //appointment record
    Route::post('/doctor/appointmentReport/{id}', [DoctorController::class, 'AddAppointmentRecord'])->name('doctor.addAppointmentRecord');
    Route::post('/doctor/eappointmentReport/{id}', [DoctorController::class, 'EditAppointmentRecord'])->name('doctor.editAppointmentRecord');
    Route::get('/doctor/getMedicinePrice/{id}', [DoctorController::class, 'getMedicinePrice']);
    Route::get('/doctor/get-medicines', [DoctorController::class, 'getMedicines']);

    Route::get('/doctor/report/{medrc_id}', [DoctorController::class, 'viewMedicalReport']);


    //filter record
    Route::post('/doctor/reports', [DoctorController::class, 'filterReportList'])->name('doctor.reports.filter');

    //Manage Schedule
    Route::post('/doctor/scheduleList', [DoctorController::class, 'AddSchedule']);
    Route::post('/doctor/scheduleList/{id}', [DoctorController::class, 'EditSchedule']);
    Route::delete('/doctor/scheduleList/{id}', [DoctorController::class, 'DeleteSchedule'])->name('DeleteSchedule');

    //attend & absent appointment
    Route::post('/doctor/dashboard/{appointment_id}', [DoctorController::class, 'AttendAppointment']);
    Route::post('/doctor/cdashboard/{appointment_id}', [DoctorController::class, 'AbsentAppointment']);


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
    Route::get('/nurse/paymentList', [NurseController::class, 'viewPaymentList']);
    Route::get('/nurse/medicineList', [NurseController::class, 'viewMedicineList']);
    Route::get('/nurse/appointmentList/{date}', [NurseController::class, 'viewAppointmentListDate'])->name('nurse.appointmentList');

    //Invoice
    Route::post('/nurse/paymentList/{id}', [NurseController::class, 'EditPayment']);

    //Report
    Route::get('/nurse/medrecordList', [NurseController::class, 'viewMedRecordList']);
    Route::get('/nurse/report/{medrc_id}', [NurseController::class, 'viewMedicalReport']);

    //Profile
    Route::post('/nurse/profile/{id}', [NurseController::class, 'EditProfile']);
    
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
    Route::get('/nurse/getDoctorSchedule/{doctorId}', [NurseController::class, 'getDoctorSchedule']);
    Route::get('/nurse/getBookedAppointmentTimes/{date}', [NurseController::class, 'getBookedAppointmentTimes']);
    Route::post('/nurse/isTimeBooked', [NurseController::class, 'isTimeBooked']);

    //attend & absent appointment
    Route::post('/nurse/dashboard/{appointment_id}', [NurseController::class, 'AttendAppointment']);
    Route::post('/nurse/cdashboard/{appointment_id}', [NurseController::class, 'AbsentAppointment']);

});

    //Patient
    Route::group(['middleware'=>['isPatient', 'auth']], function(){
    Route::get('/patient/dashboard', [PatientController::class, 'index'])->name('patient.contents.dashboard');
    Route::get('/patient/appointmentList', [PatientController::class, 'viewAppointmentList']);
    Route::get('/patient/reportList', [PatientController::class, 'viewReportList']);
    Route::get('/patient/profile', [PatientController::class, 'viewProfile']);
    Route::get('/patient/medrecord', [PatientController::class, 'viewMedRecord']);
    Route::get('/patient/medprescription', [PatientController::class, 'viewMedPrescription']);
    Route::get('/patient/appointmentList/{date1}', [PatientController::class, 'viewAppointmentListFilter'])->name('patient.appointmentList');

    //Record
    Route::get('/patient/report/{id}', [PatientController::class, 'viewReport']);

    //Manage Appoiment

    Route::post('/patient/appointmentList/{id}', [PatientController::class, 'EditAppointment']);
    Route::get('/patient/getDoctorSchedule/{doctorId}', [PatientController::class, 'getDoctorSchedule']);

    //managedetailsuser
    Route::post('/patient/profile/{id}', [PatientController::class, 'EditProfile']);

});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('patient.contents.dashboard');
