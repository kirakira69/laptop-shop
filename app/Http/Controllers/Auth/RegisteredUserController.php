<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Http; // <--- ADD THIS
use Closure; // <--- ADD THIS
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'birthdate' => ['required', 'date'],
        'phone' => ['required', 'string', 'max:20'],
        'barangay' => ['required', 'string'],
            
            // New Validations
            
            'g-recaptcha-response' => ['required', function (string $attribute, mixed $value, Closure $fail) {
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => env('RECAPTCHA_SECRET_KEY'),
                    'response' => $value,
                ]);
    
                if (!$response->json()['success']) {
                    $fail("Please complete the reCAPTCHA verification to prove you are human.");
                }
            }],
            // --- RECAPTCHA VALIDATION END ---
       
            
        ]); 

        // 1. Generate a random 6-digit code
        $otp = rand(100000, 999999);

        // 2. Create the user with the OTP and all profile fields
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            'birthdate' => $request->birthdate,
        'phone' => $request->phone,
        'barangay' => $request->barangay,
            
            // Save OTP
            'otp_code' => $otp, 
            
            // Save personal/address fields
          
        ]);

        event(new Registered($user));

        // 3. Send the Email
        Mail::to($user->email)->send(new OTPMail($otp));

        // 4. Store email in session to remember who we are verifying
        session(['email_for_verification' => $user->email]);

        // 5. Redirect to OTP Page (Do NOT login yet)
        // Note: We removed Auth::login($user); so they aren't logged in automatically
        
        return redirect()->route('otp.verify');
    }
}