<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Show the user's profile.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    
    public function showAdmin()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('admin.adminProfile', compact('user'));
    }

    public function showDoctor()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('doctor.doctorProfile', compact('user'));
    }

    public function showPatient()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Pass the user data to the view
        return view('patient.profile', compact('user'));
    }

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'telephone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'birth_day' => 'required|date',
            'gender' => 'required|string|in:male,female,other',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Get the currently authenticated user
        $user = Auth::user();

        // Update the user's profile with the request data
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'telephone' => $request->telephone,
            'address' => $request->address,
            'birth_day' => $request->birth_day,
            'gender' => $request->gender,
        ]);

        // Redirect back with a success message
        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }

    /**
     * Change the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the current password matches the stored password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect back with a success message
        return redirect()->route('dashboard')->with('success', 'Password changed successfully.');
    }
}
