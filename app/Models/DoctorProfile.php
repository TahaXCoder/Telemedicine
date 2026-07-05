<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorProfile extends Model
{
   protected $fillable = [
    'user_id',
    'specialization',
    'experience',
    'fee',
    'city',
    'bio',
    'qualification',
    'status',
    'clinic_address',
 ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}