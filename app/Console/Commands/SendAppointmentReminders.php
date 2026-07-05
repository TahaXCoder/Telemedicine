<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Mail\AppointmentReminderPatientMail;
use App\Mail\AppointmentReminderDoctorMail;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class SendAppointmentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-appointment-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders to patients and doctors for upcoming confirmed appointments in the next 24 hours.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $in24Hours = Carbon::now()->addHours(24);

        $this->info("Checking for confirmed appointments starting between {$now} and {$in24Hours}...");

        // Query appointments within the date range first to optimize
        $appointments = Appointment::where('status', 'confirmed')
            ->where('reminder_sent', false)
            ->where('date', '<=', $in24Hours->toDateString())
            ->with(['patient', 'doctor'])
            ->get();

        $sentCount = 0;

        foreach ($appointments as $appointment) {
            $appointmentDateTime = Carbon::parse($appointment->date . ' ' . $appointment->time);

            // Double check that it falls in the precise 24 hour window
            if ($appointmentDateTime->greaterThanOrEqualTo($now) && $appointmentDateTime->lessThanOrEqualTo($in24Hours)) {
                try {
                    $this->info("Sending reminders for Appointment ID #{$appointment->id} (Scheduled at: {$appointmentDateTime})...");

                    // Send email to patient
                    Mail::to($appointment->patient->email)->send(new AppointmentReminderPatientMail($appointment));

                    // Send email to doctor
                    Mail::to($appointment->doctor->email)->send(new AppointmentReminderDoctorMail($appointment));

                    // Mark as sent
                    $appointment->reminder_sent = true;
                    $appointment->save();
                    $sentCount++;

                    $this->info("Successfully sent reminders for Appointment ID #{$appointment->id}.");
                } catch (\Exception $e) {
                    $this->error("Error sending reminders for Appointment ID #{$appointment->id}: " . $e->getMessage());
                }
            }
        }

        $this->info("Finished. Total reminders sent: {$sentCount}");
    }
}
