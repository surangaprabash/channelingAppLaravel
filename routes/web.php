<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// home routes
Route::get('/', function () {
    return view('welcome');
});


//test mail
Route::get('send-email',[MailController::class, 'sendEmail']);



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot.password.form');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOTP'])->name('forgot.password.sendOTP');
Route::get('/verify-otp', [ForgotPasswordController::class, 'showVerifyOTPForm'])->name('verify.otp.form');
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOTP'])->name('verify.otp');


//common routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    //Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    //show dashboard
    Route::middleware(['auth'])->get('/dashboard', [LoginController::class, 'index'])->name('dashboard');
});

//admin routes
Route::middleware(['auth', 'admin'])->group(function () {

    //department function in dashboard
    Route::get('/dashboard/create-department', [AdminController::class, 'createDepartment'])->name('admin.create-department');
    Route::post('/dashboard/store-department', [AdminController::class, 'storeDepartment'])->name('admin.store-department');
    Route::post('/dashboard/update-department-status/{id}', [AdminController::class, 'updateDepartmentStatus'])->name('admin.update-department-status');

    //doctor function in dashboard
    Route::get('/dashboard/doctors/create', [AdminController::class, 'create'])->name('admin.doctors.create');
    Route::post('/dashboard/doctors/store', [AdminController::class, 'store'])->name('admin.doctors.store');
    Route::get('/dashboard/doctors', [AdminController::class, 'index'])->name('admin.doctors.index');
    Route::post('/dashboard/doctors/{id}/update-status', [AdminController::class, 'updateStatus'])->name('admin.doctors.updateStatus');
    Route::get('/dashboard/doctors/{id}/edit', [AdminController::class, 'edit'])->name('admin.doctors.edit');
    Route::post('/dashboard/doctors/{id}/update', [AdminController::class, 'update'])->name('admin.doctors.update');

    //patient functions in dashboard
    Route::get('/dashboard/patients/create', [AdminController::class, 'createPatient'])->name('admin.patients.create');
    Route::post('/dashboard/patients', [AdminController::class, 'storePatient'])->name('admin.patients.store');
    Route::get('/dashboard/patients', [AdminController::class, 'indexPatient'])->name('admin.patients.index');
    Route::post('/dashboard/patients/{id}/status', [AdminController::class, 'updateStatusPatient'])->name('admin.patients.updateStatus');
    Route::get('/dashboard/patients/{id}/edit', [AdminController::class, 'editPatient'])->name('admin.patients.edit');
    Route::post('/dashboard/patients/{id}/update', [AdminController::class, 'updatePatient'])->name('admin.patients.update');


    //appointment functiona in dashboard
    Route::get('/dashboard/appointments', [AppointmentController::class, 'index'])->name('new.appointments.index');
    Route::get('/dashboard/appointments/confirm/{id}', [AppointmentController::class, 'confirmApp'])->name('appointments.confirmApp');
    Route::post('/dashboard/appointments/reject/{id}', [AppointmentController::class, 'reject'])->name('appointments.reject');
    Route::post('/dashboard/appointments/confirm/{id}', [AppointmentController::class, 'confirm'])->name('appointments.confirm');
   
    
    //appointment manage functiona in dashboard
    Route::get('/dashboard/appointments/manage', [AppointmentController::class, 'manageIndex'])->name('appointments.index');
    Route::get('/dashboard/appointments/search', [AppointmentController::class, 'search'])->name('appointments.search');
    //Route::get('/dashboard/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');

    Route::put('/dashboard/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');


    //create doctor schedule
    Route::get('/dashboard/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/dashboard/schedules/store', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::post('/dashboard/update-schedules-status/{id}', [ScheduleController::class, 'updateScheduleStatus'])->name('admin.update-schedule-status');
    Route::get('/dashboard/schedules', [ScheduleController::class, 'index'])->name('schedules.index');


    //doctor email send

    Route::get('/dashboard/send-email', [AdminController::class, 'showSendEmailForm'])->name('showSendEmailForm');
    Route::post('/dashboard/send-email', [AdminController::class, 'sendEmailToDoctor'])->name('admin.sendEmailToDoctor');



    //admin profile

    Route::get('/admin/profile', [ProfileController::class, 'showAdmin'])->name('admin.profile.show');
    Route::put('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('/admin/profile/change-password', [ProfileController::class, 'changePassword'])->name('admin.profile.change-password');

});

//doctor routes
Route::middleware(['auth', 'doctor'])->group(function () {
    

    //doctor shedule routes
    Route::get('/doctor/schedule', [DoctorController::class, 'showSchedule'])->name('doctor.schedule');

    //doctor appointment routes
    Route::get('/doctor/appointments', [DoctorController::class, 'showAppointments'])->name('doctor.appointments');
    Route::post('/doctor/appointments/update-status', [DoctorController::class, 'updateStatus'])->name('doctor.appointments.updateStatus');

    //doctor examine routes
    Route::get('/doctor/appointments/examine/{appointment}', [DoctorController::class, 'showExamineForm'])->name('doctor.appointments.examine');
    Route::post('/doctor/appointments/examine/{appointment}', [DoctorController::class, 'saveExamineData'])->name('doctor.appointments.saveExamineData');

    //patient details
    Route::get('/doctor/patients/search', [DoctorController::class, 'searchPatients'])->name('doctor.patients.search');
    Route::get('/doctor/patients/{id}', [DoctorController::class, 'showPatientDetails'])->name('doctor.patients.show');

    //doctor profile

    Route::get('/doctor/profile', [ProfileController::class, 'showDoctor'])->name('doctor.profile.show');
   
});

//patient routes
Route::middleware(['auth', 'patient'])->group(function () {
   
    //Route::get('/new-appointment', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/new-appointment', [AppointmentController::class, 'store'])->name('appointments.store');

    //patient appointment
    Route::get('/patients/appointment', [PatientController::class, 'appointment'])->name('patient.appointments.view');

    //patient create appointment
    Route::get('/patients/create-appointment', [PatientController::class, 'create'])->name('patient.appointments.create');

    //patient profile 
    Route::get('/patients/profile', [ProfileController::class, 'showPatient'])->name('patient.profile.show');

    //patient reports
    Route::get('/patient/myReport', [PatientController::class, 'myReport'])->name('patient.myReport');

});