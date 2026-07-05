<?php

namespace App\Http\Controllers;

use App\Mail\AppointmentBookedMail;
use Illuminate\Http\Request;
use App\Models\DoctorProfile;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PatientController extends Controller
{
  public function dashboard()
 {
    $appointments = Appointment::where('patient_id', auth()->id())
                    ->with('doctor.doctorProfile')
                    ->latest()
                    ->get();

    return view('patient.dashboard', compact('appointments'));
 }

    public function doctors(Request $request)
    {
        $query = DoctorProfile::where('status', 'approved')->with('user');

        if ($request->specialization) {
            $query->where('specialization', 'like', '%' . $request->specialization . '%');
        }

        if ($request->city) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        $doctors = $query->get();

        return view('patient.doctors', compact('doctors'));
    }

    public function bookAppointment($doctorId)
    {
        $doctor = DoctorProfile::where('user_id', $doctorId)->with('user')->firstOrFail();
        return view('patient.book-appointment', compact('doctor'));
    }

    public function searchDoctors(Request $request)
{
    $query = DoctorProfile::where('status', 'approved')->with('user');

    if ($request->specialization) {
        $query->where('specialization', 'like', '%' . $request->specialization . '%');
    }

    if ($request->city) {
        $query->where('city', 'like', '%' . $request->city . '%');
    }

    $doctors = $query->get();

    return view('patient.partials.doctor-cards', compact('doctors'));
}

    public function storeAppointment(Request $request, $doctorId)
    {
        $request->validate([
            'date'             => ['required', 'date', 'after:today'],
            'time'             => ['required'],
            'appointment_type' => ['required', 'in:online,physical'],
            'notes'            => ['nullable', 'string'],
        ]);

        $appointment = Appointment::create([
            'patient_id'       => auth()->id(),
            'doctor_id'        => $doctorId,
            'date'             => $request->date,
            'time'             => $request->time,
            'status'           => 'pending',
            'appointment_type' => $request->appointment_type,
            'notes'            => $request->notes,
        ]);

        $appointment->load('patient', 'doctor');
        Mail::to($appointment->patient->email)->send(new AppointmentBookedMail($appointment, 'patient'));
        Mail::to($appointment->doctor->email)->send(new AppointmentBookedMail($appointment, 'doctor'));

        return redirect()->route('patient.dashboard')
               ->with('success', 'Appointment booked successfully!');
    }

    public function aiChat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
            'history' => 'nullable|array'
        ]);

        // 1. Fetch available approved doctors
        $doctors = DoctorProfile::where('status', 'approved')
            ->with('user')
            ->get();

        if ($doctors->isEmpty()) {
            $doctorListText = "No doctors are currently available online. Please check back later.";
        } else {
            $doctorListText = $doctors->map(fn($d) =>
                "- Dr. " . ($d->user->name ?? 'Unknown') . " (Specialization: " . $d->specialization . ", City: " . $d->city . ", Fee: PKR " . $d->fee . ", Experience: " . $d->experience . " years, Qualification: " . $d->qualification . ", Clinic: " . ($d->clinic_address ?? 'Not specified') . ")"
            )->join("\n");
        }

        // 2. Fetch logged-in patient's recent appointments
        $appointments = Appointment::where('patient_id', auth()->id())
            ->with('doctor.doctorProfile')
            ->latest()
            ->take(5)
            ->get();

        if ($appointments->isEmpty()) {
            $appointmentListText = "Patient has no appointments booked yet.";
        } else {
            $appointmentListText = $appointments->map(fn($a) =>
                "- Appointment with Dr. " . ($a->doctor->name ?? 'Unknown') . " on " . $a->date . " at " . $a->time . " (" . ucfirst($a->appointment_type) . " - Status: " . ucfirst($a->status) . ")" . ($a->meeting_link ? ", Video link: " . $a->meeting_link : "")
            )->join("\n");
        }

        // 3. Fetch logged-in patient's recent prescriptions
        $prescriptions = \App\Models\Prescription::where('patient_id', auth()->id())
            ->with('doctor')
            ->latest()
            ->take(5)
            ->get();

        if ($prescriptions->isEmpty()) {
            $prescriptionListText = "Patient has no prescriptions issued yet.";
        } else {
            $prescriptionListText = $prescriptions->map(fn($p) =>
                "- Prescription from Dr. " . ($p->doctor->name ?? 'Unknown') . " on " . $p->created_at->format('Y-m-d') . ": Medicines: " . $p->medicines . ", Instructions: " . $p->instructions . ($p->notes ? ", Notes: " . $p->notes : "")
            )->join("\n");
        }

        // 4. Construct System Prompt
        $systemPrompt = "You are a helpful, empathetic, and polite medical assistant for our telemedicine app called TeleMedicine.
You help patients find the right doctors from our approved list based on their symptoms, explain how to use the app, and answer basic health questions.
You also have access to the patient's own context (appointments and prescriptions) to answer any queries they have about their records.

APP FEATURES & STATUSES:
- Patients can browse and book appointments with doctors (online or physical).
- Appointment status: pending, confirmed, completed, or cancelled.
- If an appointment is 'online' and 'confirmed', it will display a video meeting link in their dashboard or booking details.
- Doctors issue digital prescriptions post-consultation.

CURRENTLY APPROVED AVAILABLE DOCTORS:
{$doctorListText}

PATIENT'S RECENT APPOINTMENTS:
{$appointmentListText}

PATIENT'S RECENT PRESCRIPTIONS:
{$prescriptionListText}

RULES:
1. ONLY suggest or recommend doctors from the approved list above based on patient symptoms.
2. If no doctor on the list matches the specialization, politely state that no specialist is currently available. Do NOT recommend imaginary doctors.
3. If they ask about their appointments or prescriptions, consult the patient's context sections above to give them precise dates, times, doctors, status, and medicine details.
4. For serious emergencies (e.g. chest pain, severe bleeding, difficulty breathing), immediately advise them to visit the nearest emergency room or call emergency services.
5. Keep your responses friendly, concise, and formatted in clear text or short paragraphs. Avoid overly long replies.";

        // 5. Structure history and current message
        $messages = [];
        $messages[] = ['role' => 'system', 'content' => $systemPrompt];

        if ($request->has('history')) {
            foreach ($request->history as $h) {
                $role = $h['role'] ?? null;
                if ($role === 'patient' || $role === 'user') {
                    $role = 'user';
                } elseif ($role === 'bot' || $role === 'assistant') {
                    $role = 'assistant';
                }

                if ($role && !empty($h['content'])) {
                    $messages[] = ['role' => $role, 'content' => $h['content']];
                }
            }
        }

        $messages[] = ['role' => 'user', 'content' => $request->message];

        // 6. Call OpenRouter endpoint
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model'       => 'google/gemini-2.5-flash',
            'messages'    => $messages,
            'temperature' => 0.5,
            'max_tokens'  => 1000,
        ]);

        $data = $response->json();
        \Illuminate\Support\Facades\Log::info('OpenRouter Response', ['data' => $data, 'status' => $response->status()]);

        if ($response->failed()) {
            $errorMessage = $data['error']['message'] ?? 'Unknown API Error';
            return response()->json(['reply' => "API Error (Status {$response->status()}): {$errorMessage}"]);
        }

        $reply = $data['choices'][0]['message']['content'] ?? null;

        if (!$reply) {
            $innerError = $data['error']['message'] ?? 'No response content';
            return response()->json(['reply' => "OpenRouter Error: {$innerError}"]);
        }

        return response()->json(['reply' => $reply]);
    }
}