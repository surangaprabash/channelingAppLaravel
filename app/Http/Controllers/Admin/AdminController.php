<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Mail\DoctorScheduleEmail;

class AdminController extends Controller
{
    
    public function createDepartment()
    {
        $departments = Department::all(); // Fetch all departments to list them
        return view('admin.create-department', compact('departments'));
    }

    public function storeDepartment(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Department::create([
            'name' => $validatedData['name'],
            'status' => 'active', // Set default status to active
        ]);

        return redirect()->route('admin.create-department')->with('success', 'Department created successfully!');
    }

    public function updateDepartmentStatus($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return redirect()->route('admin.create-department')->with('error', 'Department not found.');
        }

        $department->status = $department->status === 'active' ? 'inactive' : 'active';
        $department->save();

        return redirect()->route('admin.create-department')->with('success', 'Department status updated successfully!');
    }



    //admin Doctor create 
    public function create()
    {
        return view('admin.addDoctor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:15',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
            'short_biography' => 'required|string',
            'status' => 'required|string',
        ]);


        // Find the latest user ID for doctors
        $latestUser = User::where('role', 'doctor')->orderBy('id', 'desc')->first();

        if ($latestUser) {
            // Extract the numeric part of the ID (e.g., from "Did-009" to "009")
            $latestId = intval(substr($latestUser->user_id, 4));

            // Generate the next ID incrementally
            $nextId = 'Did-' . str_pad($latestId + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // If no doctors exist yet, start with "Did-001"
            $nextId = 'Did-001';
        }

        $user_id = $nextId;

        $user = new User();
        $user->user_id = $user_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->telephone = $request->phone;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->short_biography = $request->short_biography;
        $user->status = $request->status;
        $user->role = 'doctor';
        $user->save();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor added successfully.');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $doctors = User::query()
            ->where('role', 'doctor')
            ->when($search, function ($query, $search) {
                // Ensure search only affects doctor data
                return $query->where(function ($query) use ($search) {
                    $query->where('user_id', 'LIKE', "%{$search}%")
                        ->orWhere('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            })
            ->get();

        return view('admin.manageDoctor', compact('doctors', 'search'));
    }

    public function updateStatus($id)
    {
        $user = User::find($id);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor status updated successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'gender' => 'required|string',
            'address' => 'required|string|max:255',
            'short_biography' => 'required|string',
            'status' => 'required|string',
        ]);

        $user = User::find($id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'telephone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'short_biography' => $request->short_biography,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor details updated successfully.');
    }


    //patient function 

    public function createPatient()
    {
        return view('admin.addPatient');
    }

    public function storePatient(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15',
            'gender' => 'required|string',
            'birthday' => 'required|date',
            'address' => 'required|string|max:255',
        ]);

         // Find the latest user ID for doctors
         $latestUser = User::where('role', 'patient')->orderBy('id', 'desc')->first();

         if ($latestUser) {
             // Extract the numeric part of the ID
             $latestId = intval(substr($latestUser->user_id, 4));
 
             // Generate the next ID incrementally
             $nextId = 'Pid-' . str_pad($latestId + 1, 3, '0', STR_PAD_LEFT);
         } else {
             // If no patient exist yet, start with "Pid-001"
             $nextId = 'Pid-001';
         }

        $user_id = $nextId;

        $user = new User();
        $user->user_id = $user_id;
        $user->first_name = $request->firstname;
        $user->last_name = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->telephone = $request->phone;
        $user->gender = $request->gender;
        $user->birth_day = $request->birthday;
        $user->address = $request->address;
        $user->status = 'active';
        $user->role = 'patient';
        $user->save();

        return redirect()->route('admin.patients.index')->with('success', 'Patient added successfully');
    }

    public function indexPatient(Request $request)
    {
        $search = $request->input('search');
        
        $patients = User::query()
            ->where('role', 'patient')
            ->when($search, function ($query, $search) {
                // Ensure search only affects patient data
                return $query->where(function ($query) use ($search) {
                    $query->where('user_id', 'LIKE', "%{$search}%")
                        ->orWhere('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%");
                });
            })
            ->get();

        return view('admin.managePatient', compact('patients', 'search'));
    }

    public function updateStatusPatient($id)
    {
        $user = User::find($id);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();

        return redirect()->route('admin.patients.index')->with('success', 'Patient status updated successfully.');
    }

    public function editPatient($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function updatePatient(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'gender' => 'required|string',
            'birthday' => 'required|date',
            'address' => 'required|string|max:255',
        ]);

        $user = User::find($id);
        $user->update([
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email,
            'telephone' => $request->phone,
            'gender' => $request->gender,
            'birth_day' => $request->birthday,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.patients.index')->with('success', 'Patient details updated successfully.');
    }



    //email send to doctors

    public function showSendEmailForm()
    {
        // Fetch all doctors
        $doctors = User::where('role', 'doctor')->get();

        return view('admin.sendEmail', compact('doctors'));
    }

    public function sendEmailToDoctor(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'from_time' => 'required|date_format:H:i',
            'to_time' => 'required|date_format:H:i',
            'department' => 'required|string|max:255',
            'additional_department' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        $doctor = User::find($request->doctor_id);
        $details = [
            'doctor_name' => 'Dr. ' . $doctor->first_name . ' ' . $doctor->last_name,
            'from_time' => $request->from_time,
            'to_time' => $request->to_time,
            'department' => $request->department,
            'additional_department' => $request->additional_department,
            'additional_message' => $request->message,
        ];

        Mail::to($doctor->email)->send(new DoctorScheduleEmail($details));

        return back()->with('success', 'Email sent successfully!');
    }

}
