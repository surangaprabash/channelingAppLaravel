<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'req_app_id', 
        'user_id', 
        'doctor_id', 
        'ticket_number', 
        'department_id', 
        'appointment_date', 
        'time', 
        'message', 
        'examine',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function doctor()
    // {
    //     return $this->belongsTo(User::class, 'doctor_id');
    // }

    // public function department()
    // {
    //     return $this->belongsTo(Department::class);
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function appointmentDetails()
    {
        return $this->hasOne(Appointment::class, 'req_app_id');
    }
}
