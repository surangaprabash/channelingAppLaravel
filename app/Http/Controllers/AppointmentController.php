<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\NewAppointment;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmed;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
            'doctor_id' => 'required|exists:users,id', // Ensure doctor_id exists in users table
            'appointment_date' => 'required|date',
            'message' => 'nullable|string|max:255',
        ]);

        // Save the new appointment
        NewAppointment::create([
            'user_id' => $validatedData['user_id'],
            'department_id' => $validatedData['department_id'],
            'doctor_id' => $validatedData['doctor_id'],
            'appointment_date' => $validatedData['appointment_date'],
            'message' => $validatedData['message'],
            'appointment_status' => '1', // Set default appointment status to 1
        ]);

        // Redirect back with success message
        return redirect()->route('patient.appointments.view')->with('success', 'Appointment created successfully!');
    }


    public function index()
    {
        // Fetch the latest appointments with pagination (20 per page)
        //$appointments = NewAppointment::orderBy('created_at', 'desc')->paginate(20);
        $appointments = NewAppointment::with(['user', 'doctor', 'department'])->orderBy('created_at', 'desc')->paginate(10);


        // Count of new appointments
        $newAppointmentCount = NewAppointment::where('appointment_status', 1)->count();

        return view('admin.newApp', compact('appointments', 'newAppointmentCount'));
    }


    public function reject($id)
    {
        $appointment = NewAppointment::findOrFail($id);
        $appointment->appointment_status = 3; // Rejected
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Appointment rejected successfully!');
    }


    public function confirmApp($id)
    {
        $appointment = NewAppointment::findOrFail($id);
        $doctors = User::where('role', 'doctor')->get();
        
        // Generate unique ticket ID
        $ticketId = $this->generateUniqueTicketId();

        return view('admin.confirmApp', compact('appointment', 'doctors', 'ticketId'));
    }


    //tiket id generater
    private function generateUniqueTicketId()
    {
        $ticketId = 'TID-' . mt_rand(1000000000, 9999999999); // Generate random number

        // Check if ticket ID already exists in the database
        while (User::where('user_id', $ticketId)->exists()) {
            $ticketId = 'TID-' . mt_rand(1000000000, 9999999999); // Regenerate if exists
        }

        return $ticketId;
    }

    public function confirm(Request $request, $id)
    {
        // Fetch data from new_appointments table
        $newAppointment = NewAppointment::find($id);

        // Update appointment status to confirmed 
        $newAppointment->appointment_status = 2; // Confirmed
        $newAppointment->save();

        // Create a new Appointment record
        $appointment = new Appointment();
        $appointment->req_app_id = $newAppointment->id; // Assuming req_app_id is the foreign key relation to new_appointments table
        $appointment->user_id = $newAppointment->user_id;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->ticket_number = $request->ticket_number; // Use the value from the form input
        $appointment->department_id = $newAppointment->department_id;
        $appointment->appointment_date = $request->appointment_date;
        $appointment->time = $request->time;
        $appointment->message = $request->message;
        $appointment->examine = 1; // Setting the examine field to 1 by default

        $appointment->save();

         // Send email to user
        try {
            Mail::to($newAppointment->user->email)->send(new AppointmentConfirmed($appointment));
        } catch (\Exception $e) {
            // Handle any exceptions or log errors
            return back()->withErrors(['email' => 'Failed to send email.']);
        }

        // Optionally, you can delete the new_appointment after confirmation
        // $newAppointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment confirmed successfully!');
    }




    //manage appointments methods

    public function manageIndex()
    {
        $appointments = Appointment::with(['user', 'doctor', 'department'])->orderBy('created_at', 'desc')->paginate(10);

        $doctors = User::where('role', 'doctor')->get();

        //$appointments = Appointment::all(); // Or use pagination for large datasets
        return view('admin.manageAppointments', compact('appointments', 'doctors'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $doctors = User::where('role', 'doctor')->get();

        $appointments = Appointment::where('ticket_number', 'like', "%$search%")
                                    ->orWhereHas('user', function ($query) use ($search) {
                                        $query->where('first_name', 'like', "%$search%")
                                            ->orWhere('last_name', 'like', "%$search%")
                                            ->orWhere('user_id', 'like', "%$search%");
                                    })
                                    ->orWhere('user_id', 'like', "%$search%")
                                    ->get();

        

        return view('admin.manageAppointments', compact('appointments', 'doctors'));
    }

    // public function edit($id)
    // {
    //     $appointment = Appointment::findOrFail($id);
    //     return view('admin.manageAppointments', compact('appointment'));
    // }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->doctor_id = $request->input('doctor_id');
        $appointment->appointment_date = $request->input('appointment_date');
        $appointment->time = $request->input('time');
        $appointment->examine = $request->input('examine');
        $appointment->save();

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

}
