<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }
        return view('register');
    }

    // Handle the registration process
    public function register(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'telephone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'birth_day' => 'required|date',
            'gender' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

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

       $userId = $nextId;

        // Create a new user
        User::create([
            'user_id' => $userId,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'address' => $request->address,
            'birth_day' => $request->birth_day,
            'gender' => $request->gender,
            'role' => 'patient', // default role
            'status' => 'active', // default status
        ]);

        // Redirect to a success page or login
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
