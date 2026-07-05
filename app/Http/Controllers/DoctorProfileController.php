<?php

namespace App\Http\Controllers;

use App\Mail\DoctorRegistrationPendingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\DoctorProfile;

class DoctorProfileController extends Controller
{
    // Show form to create profile
    public function create()
    {
        return view('doctor.profile-setup');
    }

    // Save profile
   public function store(Request $request)
{
    $request->validate([
        'specialization'  => ['required', 'string'],
        'experience'      => ['required', 'integer'],
        'fee'             => ['required', 'numeric'],
        'city'            => ['required', 'string'],
        'bio'             => ['required', 'string'],
        'qualification'   => ['required', 'string'],
        'clinic_address'  => ['nullable', 'string'],
    ]);

    DoctorProfile::create([
        'user_id'         => auth()->id(),
        'specialization'  => $request->specialization,
        'experience'      => $request->experience,
        'fee'             => $request->fee,
        'city'            => $request->city,
        'bio'             => $request->bio,
        'qualification'   => $request->qualification,
        'clinic_address'  => $request->clinic_address,
        'status'          => 'pending',
    ]);

    $user = $request->user();
    Mail::to($user->email)->send(new DoctorRegistrationPendingMail($user));

    return redirect()->route('doctor.dashboard')
           ->with('success', 'Profile submitted! Waiting for admin approval.');
}
}