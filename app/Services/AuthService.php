<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
class AuthService
{
    public function register(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
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

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validatedData = $validator->validated();

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone_number = $validatedData['phone_number'];
        $user->pincode = $validatedData['pincode'];
        $user->city = $validatedData['city'];
        $user->district = $validatedData['district'];
        $user->state = $validatedData['state'];
        $user->country = $validatedData['country'];
        $user->gas_bill = $validatedData['gas_bill'] ?? null;
        $user->salary_slip = $validatedData['salary_slip'] ?? null;
        $user->password = Hash::make($validatedData['password']);
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return ['user' => $user, 'token' => $token];
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

        // if (!Auth::attempt($credentials)) {
        //     throw ValidationException::withMessages(['error' => 'Invalid credentials.']);
        // }

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

    public function verifyOTP(User $user, $otp)
    {

     
        if (!$user->otp ) {
            throw ValidationException::withMessages(['error' => 'Invalid OTP or OTP expired.']);
        }

        // Clear OTP after successful verification
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return true;
    }
}
