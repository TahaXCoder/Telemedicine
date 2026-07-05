<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PrescriptionReadyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $prescription;

    public function __construct($prescription)
    {
        $this->prescription = $prescription;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '💊 Your Prescription is Ready!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.prescription-ready',
        );
    }
}
