<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http; // If using an external SMS API

class ForgotPasswordController extends Controller
{

    public function ForgetPassword()
    {
        return view('auth.forgetpassword');
    }

    public function sendOtp(Request $request)
    {
        // Validate the phone number or email input
        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve email or phone number from request
        $input = $request->email_or_phone;
        $user = User::where('email', $input)->orWhere('phone_number', $input)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email_or_phone' => 'User not found'])->withInput();
        }

        // Generate a random OTP
        $otp = rand(100000, 999999);

        // Update or insert OTP into the users table
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        Mail::to($user->email)->send(new OtpMail($otp));
        
        // Replace with actual email or SMS service integration
        // Example for email: Mail::to($user->email)->send(new OtpMail($otp));
        // Example for SMS: Http::get('https://smsapi.com/send', ['phone_number' => $user->phone_number, 'message' => 'Your OTP is: ' . $otp]);

        // Simulate OTP sent successfully
        return redirect()->back()->with('success', 'OTP sent successfully.')->with('input', $input);
    }

    public function verifyOtp(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'otp' => 'required|array|size:6',
            'password' => 'required|string|min:8|confirmed',
            'email_or_phone' => 'required',
        ]);
    
        // Redirect back if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        // Retrieve email or phone number and OTP from request
        $input = $request->email_or_phone;
        $otp = implode('', $request->otp);
        $password = $request->password;
    
        // Validate OTP against stored OTP
        $user = User::where(function($query) use ($input) {
            $query->where('email', $input)
                  ->orWhere('phone_number', $input);
        })
        ->where('otp', $otp)
        ->first();
    
        if (!$user) {
            // Invalid OTP
            return redirect()->back()
                ->withErrors(['otp' => 'Invalid OTP entered. Please try again.'])
                ->withInput();
        }
    
        // Update user's password
        $user->password = Hash::make($password);
        $user->otp = null; // Clear OTP after successful validation (optional)
        $user->save();
    
        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Password reset successfully. You can now login with your new password.');
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


    

}
