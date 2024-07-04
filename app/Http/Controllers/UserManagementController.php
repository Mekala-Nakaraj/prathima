<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserKyc;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    // public function ProfileShow()
    // {
    //     $users = \App\Models\User::all();
    //     // $userKyc = auth()->userKyc();
    //     return view('backend.pages.profile.profile', compact('users'));
    // }
    public function ProfileShow()
    {
        $user = auth()->user();
        // $userKyc = auth()->userKyc();
        return view('backend.pages.profile.profile', compact('user'));
    }
    public function profileUpdate(Request $request)
    {
        // dd("hello");
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->update($request->only(['name']));

        return back()->with('success', 'Profile updated successfully!');

    }
    public function ProfileupdateKyc(Request $request)
    {
        $user = auth()->user();

        $kycData = [
            // 'user_id' => $this->generateUserId(),
            'aadhar_number' => $request->input('aadhar_number'),
            'pan_number' => $request->input('pan_number'),
            'account_number' => $request->input('account_number'),
            'ifsc_code' => $request->input('ifsc_code'),
            'is_verified' => true, 
        ];

        if ($user->kyc) {
            $user->kyc->update($kycData); 
        } else {
            $user->kyc()->create($kycData); 
        }

        return redirect()->back()->with('success', 'KYC details updated successfully.');
    }
  
    public function CustomerManagement()
    {
        // $users = auth()->user();
        $users = \App\Models\User::all();
        // $users = \App\Models\User::all();
        return view('backend.pages.customer.customer', compact('users'));
    }
    public function CustomerManagementStore(Request $request)
    {
        // dd('heelo');
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|unique:users,phone_number',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
        ], [
            'email.unique' => 'The email address is already taken.',
            'phone_number.unique' => 'The phone number is already taken.',
            'password' => 'Password does not math',
            'password_confirmation' => 'Password does not math',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'password' => bcrypt($validatedData['password']), 
        ]);

      
        return redirect()->back()->with('success', 'Customer created successfully!');
    }
    public function CustomerKYC()
    {
        $users = User::with('kyc')->get(); 
        // $userKyc = auth()->userKyc();
        return view('backend.pages.customer.customerkyc', compact('users'));
    }
    public function CustomerKYCVerified(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'is_verified' => 'required|boolean', 
        ]);
    
        $userKyc = UserKyc::where('user_id', $userId)->firstOrFail();
    
        $userKyc->is_verified = $validatedData['is_verified'];
    
        if ($validatedData['is_verified'] == 1) {
            $userKyc->status = 'Verified';
        } elseif ($validatedData['is_verified'] == 0) {
            $userKyc->status = 'Rejected';
        }
    
        $userKyc->save();
    
        return redirect()->back()->with('success', 'KYC verification status updated successfully.');
    }
}
