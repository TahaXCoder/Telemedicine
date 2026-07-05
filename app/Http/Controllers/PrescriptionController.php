<?php

namespace App\Http\Controllers;

use App\Mail\PrescriptionReadyMail;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;

class PrescriptionController extends Controller
{
    // Doctor - Show form to write prescription
    public function create($appointmentId)
    {
        $appointment = Appointment::with('patient')
                       ->where('id', $appointmentId)
                       ->where('doctor_id', auth()->id())
                       ->firstOrFail();

        return view('doctor.prescription-create', compact('appointment'));
    }

    // Doctor - Save prescription
    public function store(Request $request, $appointmentId)
    {
        $request->validate([
            'medicines'    => ['required', 'string'],
            'instructions' => ['required', 'string'],
            'notes'        => ['nullable', 'string'],
        ]);

        $appointment = Appointment::findOrFail($appointmentId);

        $prescription = Prescription::create([
            'appointment_id' => $appointmentId,
            'doctor_id'      => auth()->id(),
            'patient_id'     => $appointment->patient_id,
            'medicines'      => $request->medicines,
            'instructions'   => $request->instructions,
            'notes'          => $request->notes,
        ]);

        $prescription->load('patient', 'doctor');
        Mail::to($prescription->patient->email)->send(new PrescriptionReadyMail($prescription));

        // Mark appointment as completed
        $appointment->update(['status' => 'completed']);

        return redirect()->route('doctor.dashboard')
               ->with('success', 'Prescription written and appointment completed!');
    }

    // Patient - View all prescriptions
    public function index()
    {
        $prescriptions = Prescription::where('patient_id', auth()->id())
                         ->with('doctor', 'appointment')
                         ->latest()
                         ->get();

        return view('patient.prescriptions', compact('prescriptions'));
    }

    // Patient - View single prescription
    public function show($id)
    {
        $prescription = Prescription::where('id', $id)
                        ->where('patient_id', auth()->id())
                        ->with('doctor.doctorProfile', 'appointment')
                        ->firstOrFail();

        return view('patient.prescription-show', compact('prescription'));
    }
}