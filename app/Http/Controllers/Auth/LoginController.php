<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\NewAppointment;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }
        return view('login');
    }

    // Handle the login process
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect to intended URL after login
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Handle role-based redirection and load dashboards
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {

            $totalPatients = User::where('role', 'patient')->count();
            $totalDoctors = User::where('role', 'doctor')->count();
            $totalDepartments = Department::count();
    
            return view('admin.dashboard', compact('totalPatients', 'totalDoctors', 'totalDepartments'));

        }elseif ($user->role === 'doctor') {

            return view('doctor.dashboard');

        } elseif ($user->role === 'patient') {

            

            $schedules = Schedule::all();

            return view('patient.dashboard', compact('schedules'));
            
        
            //return view('patient.dashboard');
            
        } else {
            // Optionally handle other roles or show an unauthorized message
            abort(403, 'Unauthorized action.');
        }
    }
}
