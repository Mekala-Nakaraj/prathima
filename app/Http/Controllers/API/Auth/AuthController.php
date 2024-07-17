<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authService;
    protected $userRepo;

    public function __construct(AuthService $authService, User $userRepo)
    {
        $this->authService = $authService;
        $this->userRepo = $userRepo;
    }

    public function register(Request $request)
    {
        try {
            $result = $this->authService->register($request->all());
            $user = $result['user'];
            $token = $result['token'];

            return response()->json([
                'message' => 'Registration successful!',
                'user' => $user,
                'token' => $token
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            if ($request->has('email') && $request->has('password')) {
                // Login with email/password
                $credentials = $request->only('email', 'password');
                $result = $this->authService->login($credentials);

            } elseif ($request->has('phone_number') && $request->has('otp')) {

                // Login with phone number and OTP
                $credentials = $request->only('phone_number', 'otp');
                $user = $this->userRepo::where('phone_number', $credentials['phone_number'])->firstOrFail();
                $this->authService->verifyOTP($user, $credentials['otp']);
                $result = $this->authService->login(['phone_number' => $credentials['phone_number']]);
            } else {
                throw ValidationException::withMessages(['error' => 'Invalid login credentials.']);
            }

            return response()->json([
                'message' => 'Login successful!',
                'user' => $result['user'],
                'token' => $result['token']
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Login failed!'. $e], 500);
        }
    }

    public function sendOTP(Request $request)
    {
        try {
            $request->validate([
                'phone_number' => 'required|string|max:20',
            ]);

            $user = User::where('phone_number', $request->phone_number)->firstOrFail();
            $otp = $this->authService->generateOTP($user);

            // Send OTP via SMS
            // $this->otpService->sendSMS($user->phone_number, "Your OTP for login is: $otp");

            return response()->json([
                'message' => 'OTP sent successfully!',
                'OTP' => $otp
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send OTP!'], 500);
        }
    }
}
