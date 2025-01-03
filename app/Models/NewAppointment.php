<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewAppointment extends Model
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_BOOKED = 2;
    const STATUS_REJECTED = 3;

    protected $fillable = [
        'user_id',
        'department_id',
        'doctor_id',
        'appointment_date',
        'message',
        'appointment_status',
    ];


    public function getStatusLabelAttribute()
    {
        switch ($this->appointment_status) {
            case self::STATUS_PENDING:
                return 'Pending';
            case self::STATUS_BOOKED:
                return 'Booked';
            case self::STATUS_REJECTED:
                return 'Rejected';
            default:
                return 'Unknown Status';
        }
    }

    public function user()
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

    public function newAppointment()
    {
        return $this->belongsTo(NewAppointment::class, 'req_app_id');
    }
}
