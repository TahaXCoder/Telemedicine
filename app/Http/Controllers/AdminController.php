<?php

namespace App\Http\Controllers;

use App\Mail\DoctorApprovedMail;
use App\Mail\DoctorRejectedMail;
use Illuminate\Http\Request;
use App\Models\DoctorProfile;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalDoctors      = User::where('role', 'doctor')->count();
        $totalPatients     = User::where('role', 'patient')->count();
        $totalAppointments = Appointment::count();
        $pendingDoctors    = DoctorProfile::where('status', 'pending')->with('user')->get();

        return view('admin.dashboard', compact(
            'totalDoctors',
            'totalPatients',
            'totalAppointments',
            'pendingDoctors'
        ));
    }

    public function approveDoctor($id)
    {
        $doctorProfile = DoctorProfile::where('id', $id)->with('user')->first();
        DoctorProfile::where('id', $id)->update(['status' => 'approved']);
        Mail::to($doctorProfile->user->email)->send(new DoctorApprovedMail($doctorProfile->user));
        return redirect()->route('admin.dashboard')
               ->with('success', 'Doctor approved successfully!');
    }

    public function rejectDoctor($id)
    {
        $doctorProfile = DoctorProfile::where('id', $id)->with('user')->first();
        DoctorProfile::where('id', $id)->update(['status' => 'rejected']);
        Mail::to($doctorProfile->user->email)->send(new DoctorRejectedMail($doctorProfile->user));
        return redirect()->route('admin.dashboard')
               ->with('success', 'Doctor rejected.');
    }

    public function doctors()
    {
        $doctors = DoctorProfile::with('user')->latest()->get();
        return view('admin.doctors', compact('doctors'));
    }

    public function patients()
    {
        $patients = User::where('role', 'patient')->latest()->get();
        return view('admin.patients', compact('patients'));
    }

    public function appointments()
    {
        $appointments = Appointment::with('patient', 'doctor')->latest()->get();
        return view('admin.appointments', compact('appointments'));
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_blocked' => !$user->is_blocked]);
        $status = $user->is_blocked ? 'blocked' : 'unblocked';
        return back()->with('success', "User {$status} successfully!");
    }
}