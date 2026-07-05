<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentCancelledMail;
use App\Mail\AppointmentConfirmedMail;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

class DoctorController extends Controller
{
    public function dashboard()
    {
        $appointments = Appointment::where('doctor_id', auth()->id())
                        ->with('patient')
                        ->latest()
                        ->get();

        return view('doctor.dashboard', compact('appointments'));
    }

    public function confirmAppointment($id)
    {
        $appointment = Appointment::where('id', $id)
                       ->where('doctor_id', auth()->id())
                       ->with('patient', 'doctor')
                       ->first();
        $appointment->update(['status' => 'confirmed']);
        Mail::to($appointment->patient->email)->send(new AppointmentConfirmedMail($appointment));

        return redirect()->route('doctor.dashboard')
               ->with('success', 'Appointment confirmed!');
    }

    public function cancelAppointment($id)
    {
        $appointment = Appointment::where('id', $id)
                       ->where('doctor_id', auth()->id())
                       ->with('patient', 'doctor')
                       ->first();
        $appointment->update(['status' => 'cancelled']);
        Mail::to($appointment->patient->email)->send(new AppointmentCancelledMail($appointment));

        return redirect()->route('doctor.dashboard')
               ->with('success', 'Appointment cancelled.');
    }

    public function completeAppointment($id)
    {
        Appointment::where('id', $id)
                   ->where('doctor_id', auth()->id())
                   ->update(['status' => 'completed']);

        return redirect()->route('doctor.dashboard')
               ->with('success', 'Appointment marked as completed!');
    }

   public function addMeetingLink(Request $request, $id)
{
    $request->validate([
        'meeting_link' => ['required', 'string'],
    ]);

    Appointment::where('id', $id)
               ->where('doctor_id', auth()->id())
               ->update(['meeting_link' => $request->meeting_link]);

    return redirect()->route('doctor.dashboard')
               ->with('success', 'Meeting link sent to patient!');
}
}