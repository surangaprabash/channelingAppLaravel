<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\NewAppointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function create()
    {
       // Fetch departments where status is 1 (active)
        $departments = Department::where('status', 'active')->get();

       // Fetch doctors where role is 'doctor' and status is 'active'
        $doctors = User::where('role', 'doctor')->where('status', 'active')->get();

        return view('patient.create', compact(  'doctors', 'departments'));

        //return view('patient.dashboard', compact('user', 'departments', 'doctors', 'appointments'));
    }

    public function appointment()
    {
        $user = Auth::user();
        $appointments = NewAppointment::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->with(['department', 'doctor']) // Eager load the department and doctor relationships
            ->get();

        // Fetch additional details for each appointment from the Appointment model
        foreach ($appointments as $appointment) {
            $details = Appointment::where('req_app_id', $appointment->id)->first();

            // Check if $details is not null before accessing its properties
            if ($details) {
                $appointment->ticket_number = $details->ticket_number;
                $appointment->fixed_date = $details->appointment_date;
                $appointment->time = $details->time;
                $appointment->examine = $details->examine;
                $appointment->message = $details->message;
            } else {
                // Set default values or handle the null case as needed
                $appointment->ticket_number = null;
                $appointment->fixed_date = null;
                $appointment->time = null;
                $appointment->examine = null;
                $appointment->message = null;
            }
        }

        return view('patient.appointment', compact('appointments'));
    }

    //patient report

    public function myReport()
    {
        $patientId = auth()->user()->id; // Assuming the user is authenticated
        $reports = DB::table('examine_data')
            ->join('appointments', 'examine_data.appointment_id', '=', 'appointments.id')
            ->join('users as doctors', 'examine_data.doctor_id', '=', 'doctors.id')
            ->join('users as patients', 'examine_data.patient_id', '=', 'patients.id')
            ->where('examine_data.patient_id', $patientId)
            ->select('examine_data.id', 'appointments.ticket_number', 'examine_data.created_at', 'doctors.first_name as doctor_first_name', 'doctors.last_name as doctor_last_name', 'patients.first_name as patient_first_name', 'patients.last_name as patient_last_name', 'examine_data.medicine_advice', 'examine_data.health_description')
            ->orderBy('examine_data.created_at', 'desc')
            ->get();
    
        // Convert created_at to Carbon instance
        $reports->transform(function($report) {
            $report->created_at = \Carbon\Carbon::parse($report->created_at);
            return $report;
        });
    
        return view('patient.myReport', compact('reports'));
    }
    

}
