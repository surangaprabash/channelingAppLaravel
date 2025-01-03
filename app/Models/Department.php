<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status', 
    ];

    // Define the inverse relationship to the NewAppointment model
    public function appointments()
    {
        return $this->hasMany(NewAppointment::class, 'department_id');
    }
}
