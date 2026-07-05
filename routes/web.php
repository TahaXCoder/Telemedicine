<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorProfileController;
use App\Http\Controllers\PrescriptionController;

Route::get('/', function () {
    return view('welcome');
});




// Patient Routes
Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
    Route::get('/patient/doctors', [PatientController::class, 'doctors'])->name('patient.doctors');
    Route::get('/patient/doctors/search', [PatientController::class, 'searchDoctors'])->name('patient.doctors.search');
    Route::get('/patient/book/{doctorId}', [PatientController::class, 'bookAppointment'])->name('patient.book');
    Route::post('/patient/book/{doctorId}', [PatientController::class, 'storeAppointment'])->name('patient.book.store');
    Route::get('/patient/prescriptions', [PrescriptionController::class, 'index'])->name('patient.prescriptions');
    Route::get('/patient/prescriptions/{id}', [PrescriptionController::class, 'show'])->name('prescription.show');
    Route::post('/patient/ai-chat', [PatientController::class, 'aiChat'])->name('patient.ai-chat');
});

// Doctor Routes
Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorController::class, 'dashboard'])->name('doctor.dashboard');
    Route::get('/doctor/profile/create', [DoctorProfileController::class, 'create'])->name('doctor.profile.create');
    Route::post('/doctor/profile', [DoctorProfileController::class, 'store'])->name('doctor.profile.store');
    Route::post('/doctor/confirm/{id}', [DoctorController::class, 'confirmAppointment'])->name('doctor.confirm');
    Route::post('/doctor/cancel/{id}', [DoctorController::class, 'cancelAppointment'])->name('doctor.cancel');
    Route::post('/doctor/complete/{id}', [DoctorController::class, 'completeAppointment'])->name('doctor.complete');
    Route::get('/doctor/prescription/{appointmentId}', [PrescriptionController::class, 'create'])->name('prescription.create');
    Route::post('/doctor/prescription/{appointmentId}', [PrescriptionController::class, 'store'])->name('prescription.store');
    Route::post('/doctor/meeting/{id}', [DoctorController::class, 'addMeetingLink'])->name('doctor.meeting');
});


// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approveDoctor'])->name('admin.approve');
    Route::post('/admin/reject/{id}', [AdminController::class, 'rejectDoctor'])->name('admin.reject');
    Route::get('/admin/doctors', [AdminController::class, 'doctors'])->name('admin.doctors');
    Route::get('/admin/patients', [AdminController::class, 'patients'])->name('admin.patients');
    Route::get('/admin/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
    Route::post('/admin/block/{id}', [AdminController::class, 'blockUser'])->name('admin.block');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($role === 'doctor') {
        return redirect()->route('doctor.dashboard');
    }

    return redirect()->route('patient.dashboard');
})->name('dashboard');

Route::middleware('auth')->get('/mailtrap-test', function () {
    if (!app()->isLocal()) {
        abort(404);
    }

    $user = auth()->user();
    Mail::raw('Mailtrap test email from Telemedicine.', function ($message) use ($user) {
        $message->to($user->email)->subject('Mailtrap test');
    });

    return 'Mailtrap test sent.';
})->name('mailtrap.test');

require __DIR__.'/auth.php';