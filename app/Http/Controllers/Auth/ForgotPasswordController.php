<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // Show the forgot password form
    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password');
    }

    // Send OTP to email
    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Generate OTP
        $otp = rand(100000, 999999);

        // Store OTP in the database or session
        $request->session()->put('otp', $otp);
        $request->session()->put('otp_email', $request->email);

        // Send OTP to email
        Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Password Reset OTP');
        });

        return redirect()->route('verify.otp.form')->with('status', 'OTP sent to your email.');
    }

    // Show the verify OTP form
    public function showVerifyOTPForm()
    {
        return view('auth.verify_otp');
    }

    // Verify OTP
    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|integer',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check OTP
        if ($request->otp == $request->session()->get('otp')) {
            // Find the user by email stored in session
            $user = User::where('email', $request->session()->get('otp_email'))->first();
            
            // Update the user's password
            $user->password = Hash::make($request->password);
            $user->save();

            // Clear the OTP from session
            $request->session()->forget('otp');
            $request->session()->forget('otp_email');

            // Redirect to login with a success message
            return redirect()->route('login')->with('status', 'Password reset successfully. Please login with your new password.');
        }

        return redirect()->back()->withErrors(['otp' => 'Invalid OTP'])->withInput();
    }

}