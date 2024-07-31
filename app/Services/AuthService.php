<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class AuthService
{
  
    
    public function register(array $data)
    {
        // Validate the input data
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {
            // Return validation errors
            throw new ValidationException($validator);
        }
    
        $validatedData = $validator->validated();
    
        // Create the user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'password' => Hash::make($validatedData['password']),
        ]);
    
        // Generate OTP and save it in the user record
        $otp = $this->generateemailOTP($user);
    
        // Send the OTP via email
        try {
            Mail::to($user->email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            \Log::error('Failed to send OTP email:', ['error' => $e->getMessage()]);
            throw new \Exception('Failed to send OTP email. Please try again later.');
        }
  
        $numberotp = $this->generateOTP($user);
        //  $sms = $this->fast2sms($user->phone_number,$numberotp);
        // Generate an authentication token
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return [
            'user' => $user,
            'token' => $token
        ];
    }
    
    

    public function login(array $credentials)
    {
        if (isset($credentials['email'])) {
            $field = 'email';
        } elseif (isset($credentials['phone_number'])) {

            $field = 'phone_number';
        } else {
            throw ValidationException::withMessages(['error' => 'Login credentials are incorrect.']);
        }

        if (!\Auth::attempt($credentials)) {
            throw ValidationException::withMessages(['error' => 'Invalid credentials.']);
        }

        $user = User::where($field, $credentials[$field])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function generateOTP(User $user)
    {
        $otp = rand(1000, 9999); // Generate a random 4-digit OTP

        // Store the OTP in user's record or temporary storage
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10); // OTP expires in 10 minutes
        $user->save();

        // You can send the OTP via SMS or any other preferred method here
        // Example SMS sending code (you'll need to implement your SMS service)
        // SMS::send($user->phone_number, "Your OTP for login is: $otp");

        return $otp;
    }
    public function generateemailOTP(User $user)
    {
        $otp = rand(1000, 9999); // Generate a random 4-digit OTP

        // Store the OTP in user's record or temporary storage
        $user->mailotp = $otp;
        $user->email_verified_at = now()->addMinutes(10); // OTP expires in 10 minutes
        $user->save();

        // You can send the OTP via SMS or any other preferred method here
        // Example SMS sending code (you'll need to implement your SMS service)
        // SMS::send($user->phone_number, "Your OTP for login is: $otp");

        return $otp;
    }
    // app/Services/AuthService.php



    public function verifyOTP(User $user, $otp)
    {

     
        if (!$user->otp && $user->otp !== $otp) {
            throw ValidationException::withMessages(['error' => 'Invalid OTP or OTP expired.']);
        }

        // Clear OTP after successful verification
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return true;
    }
// app/Services/AuthService.php

public function verifymailOTP(User $user, $otp)
{
    // Check if OTP exists and is valid
    if ($user->mailotp !== $otp) {
        throw ValidationException::withMessages(['error' => 'Invalid or expired OTP.']);
    }

    // Clear OTP after successful verification
    $user->mailotp = null;
    $user->email_verified_at = null; // Set the email verification date
    $user->mail_verified=1;
    $user->save();

    return true;
}

// public function generatenuOTP(User $user)
// {
//     $numberotp = rand(1000, 9999); // Generate a random 4-digit OTP

//     // Store the OTP in user's record or temporary storage
//     $user->otp = $numberotp;
//     $user->otp_expires_at = now()->addMinutes(10); // OTP expires in 10 minutes
//     $user->save();

//     // You can send the OTP via SMS or any other preferred method here
//     // Example SMS sending code (you'll need to implement your SMS service)
//     // SMS::send($user->phone_number, "Your OTP for login is: $otp");

//     return $numberotp;
// }

public function verifynumberOTP(User $user, $otp)
{
    // Check if OTP exists and is valid
    if ($user->otp !== $otp) {
        throw ValidationException::withMessages(['error' => 'Invalid or expired OTP.']);
    }

    // Clear OTP after successful verification
    $user->otp = null;
    $user->otp_expires_at = null; // Set the email verification date
    $user->number_verified=1;
    $user->save();

    return true;
}

public  function fast2sms($receiver, $otp): string
    {
        $config = self::get_settings('fast2sms');
        $response = 'error';

        if (isset($config) && $config['status'] == 1) {
            $api_key = $config['api_key'];
            $url = "https://www.fast2sms.com/dev/bulkV2?authorization={$api_key}&variables_values={$otp}&route=otp&numbers=" . urlencode($receiver);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "cache-control: no-cache"
                ]
            ]);

            $response = curl_exec($curl);
            Log::info("From fast2sms" . curl_exec($curl));
            Log::info("From fast2sms OTP is " . $otp);

            $err = curl_error($curl);
            curl_close($curl);

            if (!$err && !empty($response)) {
                $response = 'success';
            } else {
                $response = 'error';
            }
        }

        return $response;
    }


}
