<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http; // If using an external SMS API

class LoginController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'alternative_email' => 'nullable|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:20',
            'pincode' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'gas_bill' => 'nullable|string|max:255',
            'salary_slip' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Assuming you have a User model with these attributes
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        // $user->alternative_email = $validatedData['alternative_email'];
        $user->phone_number = $validatedData['phone_number'];
        $user->pincode = $validatedData['pincode'];
        $user->city = $validatedData['city'];
        $user->district = $validatedData['district'];
        $user->state = $validatedData['state'];
        $user->country = $validatedData['country'];
        $user->gas_bill = $validatedData['gas_bill'];
        $user->salary_slip = $validatedData['salary_slip'];
        $user->password = bcrypt($validatedData['password']);
        
        // Save the user to the database
        $user->save();

        // Optionally, you might want to log the user in after registration
        // auth()->login($user);

        // Redirect or respond with success message
        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    
    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

     
        // Check if the user provided an email or phone number
        $username = $request->input('username');
        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

        // Prepare credentials
        $credentials = [
            $field => $username,
            'password' => $request->input('password'),
           
        ];
        // if (Auth::attempt($credentials)) {

        //     $request->session()->regenerate();

        //     return view('auth.hello');
        // }
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if ($user->user_type == 'admin') {
                // dd('admin');
                return redirect('/dashboard');
            }
            if ($user->user_type == 'field_manager') {
                // dd('user');
                return redirect('/field-manager-dashboard');
            }
            if ($user->user_type == 'relation_manager') {
                // dd('user');
                return redirect('/relation-manager-dashboard');
            }
            // if ($user->user_type == 'user') {
            //     // dd('user');
            //     return redirect('/dashboard');
            // }
    
            return view('auth.login');
        }
        // dd($credentials);

        // Attempt to authenticate the user
      

        // Authentication failed, redirect back with error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function ForgetPassword()
    {
        return view('auth.forgetpassword');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function adminDashboard()
    {
        return view('backend.dashboard');
    }

    public function Dashboard()
    {
        return view('backend.dashboard');
    }

    // public function sendOtp(Request $request)
    // {
    //     $request->validate([
    //         'phone_number' => 'required|digits:10',
    //     ]);

    //     $phone_number = $request->phone_number;
    //     $user = User::where('phone_number', $phone_number)->first();

    //     if (!$user) {
    //         // return response()->json(['success' => false, 'message' => 'User not found'], 404);
    //         return redirect()->back()->withErrors(['phone_number' => 'User not found']);
    //     }

    //     $otp = rand(100000, 999999);

    //     // Send OTP via SMS (Assuming you have an external SMS service)
    //     // Example: Http::get('https://smsapi.com/send', ['phone_number' => $phone_number, 'message' => 'Your OTP is: ' . $otp]);

    //     // Save OTP to the database (you can also store it in the cache)
    //     DB::table('users')->updateOrInsert(
    //         ['phone_number' => $phone_number],
    //         ['otp' => $otp, 'created_at' => now()]
    //     );

    //     return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
    //     // return redirect()->back()->withErrors(['phone_number' => 'sucess']);
    // }

    // public function verifyOtp(Request $request)
    // {
    //     $otp = $request->otp;
    //     $password = $request->password;

    //     $resetEntry = DB::table('password_resets')->where('otp', $otp)->first();

    //     if (!$resetEntry) {
    //         return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    //     }

    //     $user = User::where('phone', $resetEntry->phone)->first();

    //     if (!$user) {
    //         return response()->json(['success' => false, 'message' => 'User not found']);
    //     }

    //     // Update user password
    //     $user->password = Hash::make($password);
    //     $user->save();

    //     // Delete the OTP entry after successful reset
    //     DB::table('password_resets')->where('phone', $resetEntry->phone)->delete();

    //     return response()->json(['success' => true, 'message' => 'Password changed successfully']);
    // }

    // public function sendOtp(Request $request)
    // {
    //     // Validate the phone number input
    //     $validator = Validator::make($request->all(), [
    //         'phone_number' => 'required|digits:10',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Retrieve phone number from request
    //     $phone_number = $request->phone_number;

    //     // Check if user with provided phone number exists
    //     $user = User::where('phone_number', $phone_number)->first();

    //     if (!$user) {
    //         return redirect()->back()->withErrors(['phone_number' => 'User not found'])->withInput();
    //     }

    //     // Generate a random OTP (you can customize the range as needed)
    //     $otp = rand(100000, 999999);

    //     // Update or insert OTP into the users table
    //     DB::table('users')->updateOrInsert(
    //         ['phone_number' => $phone_number],
    //         ['otp' => $otp, 'created_at' => now()]
    //     );

    //     // Replace with actual SMS service integration
    //     // Example: Http::get('https://smsapi.com/send', ['phone_number' => $phone_number, 'message' => 'Your OTP is: ' . $otp]);

    //     // Simulate OTP sent successfully
    //     return redirect()->route('verifyOtp', ['phone_number' => $phone_number])->with('success', 'OTP sent successfully');
    // }

    // public function verifyOtp(Request $request)
    // {
    //     // Validate the form data
    //     $validator = Validator::make($request->all(), [
    //         'otp' => 'required|:6',
    //         'password' => 'required|string|min:8|confirmed',
    //         // 'c-password' => 'required|min:8|confirmed',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    
    //     // Retrieve phone number and OTP from request
    //     $phone_number = $request->phone_number;
    //     $otp = $request->otp;
    //     $password = $request->password;
    
    //     // Validate OTP against stored OTP and update password
    //     $user = User::where('phone_number', $phone_number)->where('otp', $otp)->first();
    
    //     if (!$user) {
    //         return redirect()->back()->withErrors(['otp' => 'Invalid OTP'])->withInput();
    //     }
    
    //     // Update user's password
    //     $user->password = Hash::make($password);
    //     $user->save();
    
    //     // Clear OTP from the database
    //     $user->update(['otp' => null]);
    
    //     // Redirect to login page with success message
    //     return redirect()->route('login')->with('success', 'Password reset successfully. You can now login with your new password.');
    // }

    // public function sendOtp(Request $request)
    // {
    //     // Validate the phone number or email input
    //     $validator = Validator::make($request->all(), [
    //         'email_or_phone' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Retrieve email or phone number from request
    //     $input = $request->email_or_phone;
    //     $user = User::where('email', $input)->orWhere('phone_number', $input)->first();

    //     if (!$user) {
    //         return redirect()->back()->withErrors(['email_or_phone' => 'User not found'])->withInput();
    //     }

    //     // Generate a random OTP
    //     $otp = rand(100000, 999999);

    //     // Update or insert OTP into the users table
    //     $user->otp = $otp;
    //     // $user->otp_expires_at = now()->addMinutes(10);
    //     $user->save();

    //     Mail::to($user->email)->send(new OtpMail($otp));

    //     // Replace with actual email or SMS service integration
    //     // Example for email: Mail::to($user->email)->send(new OtpMail($otp));
    //     // Example for SMS: Http::get('https://smsapi.com/send', ['phone_number' => $user->phone_number, 'message' => 'Your OTP is: ' . $otp]);

    //     // Simulate OTP sent successfully
    //     return redirect()->back()->with('success', 'OTP sent successfully.')->with('input', $input);
    // }

    // public function verifyOtp(Request $request)
    // {
    //     // Validate the form data
    //     $validator = Validator::make($request->all(), [
    //         'otp' => 'required|array|size:6',
    //         'password' => 'required|string|min:8|confirmed',
    //         'email_or_phone' => 'required',
    //     ]);
    
    //     // Redirect back if validation fails
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }
    
    //     // Retrieve email or phone number and OTP from request
    //     $input = $request->email_or_phone;
    //     $otp = implode('', $request->otp);
    //     $password = $request->password;
    
    //     // Validate OTP against stored OTP
    //     $user = User::where(function($query) use ($input) {
    //         $query->where('email', $input)
    //               ->orWhere('phone_number', $input);
    //     })
    //     ->where('otp', $otp)
    //     ->first();
    
    //     if (!$user) {
    //         // Invalid OTP
    //         return redirect()->back()
    //             ->withErrors(['otp' => 'Invalid OTP entered. Please try again.'])
    //             ->withInput();
    //     }
    
    //     // Update user's password
    //     $user->password = Hash::make($password);
    //     $user->otp = null; // Clear OTP after successful validation (optional)
    //     $user->save();
    
    //     // Redirect to login page with success message
    //     return redirect()->route('login')->with('success', 'Password reset successfully. You can now login with your new password.');
    // }
    
    
    



}
