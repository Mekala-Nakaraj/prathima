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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|unique:users,phone_number',
            // 'password' => 'required|string|min:8|confirmed',
            'pincode' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'gas_bill' => 'required|file|mimes:pdf|max:2048', // Example: PDF file, max 2MB
            'salary_slip' => 'required|file|mimes:pdf|max:2048', // Example: PDF file, max 2MB
            'gas_bill_number' => 'required|string|max:255',
            'salary_slip_number' => 'required|string|max:255',
        ], [
            'email.unique' => 'The email address is already taken.',
            'phone_number.unique' => 'The phone number is already taken.',
            // 'password.confirmed' => 'Password confirmation does not match.',
            'gas_bill.required' => 'Please upload your gas bill.',
            'gas_bill.mimes' => 'Please upload a valid PDF file for gas bill.',
            'gas_bill.max' => 'The gas bill file size must not exceed 2MB.',
            'salary_slip.required' => 'Please upload your salary slip.',
            'salary_slip.mimes' => 'Please upload a valid PDF file for salary slip.',
            'salary_slip.max' => 'The salary slip file size must not exceed 2MB.',
        ]);
    
        // Handle file uploads
        $gasBillPath = $request->file('gas_bill')->store('gas_bills', 'public');
        $salarySlipPath = $request->file('salary_slip')->store('salary_slips', 'public');
    
        // Create user record in database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            // 'password' => Hash::make($validatedData['password']),
            'password' => Hash::make('123@loan'),
            'pincode' => $validatedData['pincode'],
            'city' => $validatedData['city'],
            'district' => $validatedData['district'],
            'state' => $validatedData['state'],
            'country' => $validatedData['country'],
            'gas_bill_path' => $gasBillPath, // Store path or URL to the gas bill file
            'salary_slip_path' => $salarySlipPath, // Store path or URL to the salary slip file
            'gas_bill_number' => $validatedData['gas_bill_number'],
            'salary_slip_number' => $validatedData['salary_slip_number'],
        ]);
    
        // dd($user);
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
    public function CustomerLoan()
    {
        // $users = auth()->user();
        $users = \App\Models\User::all();
        // $users = \App\Models\User::all();
        return view('backend.pages.customer.customerloan', compact('users'));
    }
}
