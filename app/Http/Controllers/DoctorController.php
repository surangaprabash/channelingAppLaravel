<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ExamineData;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function showSchedule()
    {
        // Get the logged-in doctor
        $doctor = Auth::user();

        // Fetch the schedules for the logged-in doctor
        $schedules = Schedule::where('doctor_id', $doctor->id)->get();

        // Return the view with the schedules
        return view('doctor.schedule', compact('schedules'));
    }



    //appointment 


    public function showAppointments(Request $request)
    {
        // Get the logged-in doctor
        $doctor = Auth::user();

        // Fetch the appointments for the logged-in doctor
        //$query = Appointment::where('doctor_id', $doctor->id);

        // Fetch the appointments for the logged-in doctor and sort them
        // $query = Appointment::where('doctor_id', $doctor->id)
        //     ->orderByRaw("FIELD(examine, 1) DESC") // Sort to list examine == 1 first
        //     ->orderBy('created_at', 'desc'); // Then sort by creation date

        //doctor appointments
        $query = Appointment::where('doctor_id', $doctor->id)
        ->where('examine', 1) // Filter to include only examine == 1
        ->orderBy('created_at', 'desc'); // Sort by creation date

        // Apply search filter if present
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhereHas('patient', function ($q) use ($search) {
                      $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                  });
            });
        }

        //$appointments = $query->get();

        // Paginate the results to display 20 records per page
        $appointments = $query->paginate(20);

        // Return the view with the appointments
        return view('doctor.appointments', compact('appointments'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|in:2,3',
        ]);

        $appointment = Appointment::find($request->appointment_id);
        $appointment->examine = $request->status;
        $appointment->save();

        return redirect()->route('doctor.appointments')->with('status', 'The patient has not arrived!!!');
    }
    

    //patient examine

    public function showExamineForm(Appointment $appointment)
    {
        $patient = $appointment->patient;
        $doctor = Auth::user();

        return view('doctor.examine', compact('appointment', 'patient', 'doctor'));
    }

    public function saveExamineData(Request $request, Appointment $appointment)
    {
        $request->validate([
            'health_description' => 'required|string',
            'medicine_advice' => 'required|string',
        ]);

        $doctor = Auth::user();
        $patient = $appointment->patient;

        // Save the examine data
        ExamineData::create([
            'appointment_id' => $appointment->id,
            'doctor_id' => $doctor->id,
            'patient_id' => $patient->id,
            'health_description' => $request->input('health_description'),
            'medicine_advice' => $request->input('medicine_advice'),
        ]);

        // Update the appointment status to 2 (Examined)
        $appointment->examine = 2;
        $appointment->save();

        return redirect()->route('doctor.appointments')->with('status', 'The patient was successfully examine!');
    }
    

    //patient search
    public function searchPatients(Request $request)
    {
        $query = ExamineData::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('appointment', function ($q) use ($search) {
                $q->where('ticket_number', 'like', "%{$search}%")
                  ->orWhereHas('patient', function ($q) use ($search) {
                      $q->where('email', 'like', "%{$search}%")
                        ->orWhere('telephone', 'like', "%{$search}%");
                  });
            });
        }

        $examineData = $query->paginate(20);

        return view('doctor.search_patients', compact('examineData'));
    }

    // public function showPatientDetails($id)
    // {
    //     $examineData = ExamineData::findOrFail($id);
    //     return response()->json($examineData);
    // }

    public function showPatientDetails($id)
    {
        $examineData = ExamineData::with('patient', 'appointment', 'doctor')->findOrFail($id);
        return response()->json($examineData);
    }
}
