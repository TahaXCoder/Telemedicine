<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentBookedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;
    public $recipientType;

    public function __construct($appointment, $recipientType = 'patient')
    {
        $this->appointment = $appointment;
        $this->recipientType = $recipientType;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📅 Appointment Booked Successfully!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment-booked',
        );
    }
}
