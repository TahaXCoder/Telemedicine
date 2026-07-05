<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date',
        'time',
        'status',
        'notes',
        'appointment_type',
     'meeting_link',
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function prescription()
{
    return $this->hasOne(Prescription::class);
}
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}