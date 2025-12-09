<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OTPController extends Controller
{
    // 1. Show the Form
    public function show()
    {
        return view('auth.verify-otp');
    }

    // 2. Process the OTP
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        // Get the email we saved in the session during registration
        $email = session('email_for_verification');
        
        // Safety check: If session expired, send them back to login
        if(!$email) {
            return redirect()->route('login')->with('error', 'Session expired. Please login.');
        }

        // Find the user by that email
        $user = User::where('email', $email)->first();

        // Check if user exists AND if the OTP matches
        if ($user && $user->otp_code == $request->otp) {
            
            // A. Clear the OTP (so it can't be used again)
            $user->otp_code = null;
            $user->email_verified_at = now(); // Mark email as verified
            $user->save();

            // B. Log the user in
            Auth::login($user);

            // C. Clear the session email
            session()->forget('email_for_verification');

            // D. Redirect to Dashboard
            return redirect()->route('dashboard');
        }

        // If code was wrong
        return back()->withErrors(['otp' => 'Invalid OTP code. Please try again.']);
    }
}