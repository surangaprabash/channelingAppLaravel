<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{

    // manage schedule
    public function index()
    {
        $schedules = Schedule::all();
        return view('admin.manageSchedules', compact('schedules'));
    }

    // create schedule
    public function create()
    {
        $doctors = User::where('role', 'doctor')->get();
        $department = Department::all();

        //$doctors = User::where('role', 'doctor')->where('status', 'active')->get();
        
        return view('admin.doctorSchedules', compact('doctors', 'department'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor' => 'required',
            'days' => 'required|array',
            'department' => 'required',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'message' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Schedule::create([
            'doctor_id' => $request->doctor,
            'department_id' => $request->department,
            'available_days' => implode(", ", $request->days),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'message' => $request->message,
            'status' => $request->status,
        ]);

        return redirect()->route('schedules.index')->with('message', 'Schedule created successfully');
    }


    public function updateScheduleStatus($id)
    {
        $schedule = Schedule::find($id);

        if (!$schedule) {
            return redirect()->route('schedules.index')->with('error', 'Schedule not found.');
        }

        // Toggle the status between '1' and '2'
        $schedule->status = $schedule->status == '1' ? '2' : '1';
        $schedule->save();

        return redirect()->route('schedules.index')->with('success', 'Schedule status updated successfully!');
    }
}
