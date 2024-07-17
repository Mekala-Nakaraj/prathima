<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserKyc;
use App\Models\UsersLoan;
use App\Models\Loan;
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
    //KYC WithoutAPI
    // public function ProfileupdateKyc(Request $request)
    // {
    //     $request->validate([
    //         'aadhar_number' => 'required|digits:12',
    //         'pan_number' => 'required|regex:/^[A-Z0-9]{10}$/',
    //         'account_number' => 'required|regex:/^\d{11,16}$/',
    //         'ifsc_code' => 'required|regex:/^[A-Z0-9]{11}$/',
    //     ]);
    //     $user = auth()->user();

    //     $kycData = [
    //         // 'user_id' => $this->generateUserId(),
    //         'aadhar_number' => $request->input('aadhar_number'),
    //         'pan_number' => $request->input('pan_number'),
    //         'account_number' => $request->input('account_number'),
    //         'ifsc_code' => $request->input('ifsc_code'),
    //         'is_verified' => true, 
    //     ];

    //     // $verifyPanCard = new \App\Services\VerifyPanCard();
    //     // $panVerificationResponse = $verifyPanCard->verifyPAN($kycData['pan_number'], $user->phone_number);
    //     // // dd($panVerificationResponse);
    //     // if ($panVerificationResponse['status'] !== 'success') {
    //     //         return redirect()->back()->with('error', 'PAN verification failed.');
    //     // }
        
    //     // // Bank Account Verification
    //     // $verifyBankAccount = new \App\Services\VerifyBankAccount();
    //     // $bankAccountResponse = $verifyBankAccount->verifyBankDetails($kycData['account_number'], $kycData['ifsc_code'], $user->phone_number);
        
    //     // if ($bankAccountResponse['status'] !== 'success') {
    //     //     return redirect()->back()->with('error', 'Bank account verification failed.');
    //     // }

          
    //     if ($user->kyc) {
    //         dd($kycData);
    //         $user->kyc->update($kycData); 
    //     } else {
    //         dd($kycData);
    //         $user->kyc()->create($kycData); 
    //     }

    //     return redirect()->back()->with('success', 'KYC details updated successfully.');

    //     //API Intragtion//
    //     // $verifyPanCard = new \App\Services\VerifyPanCard();
    //     // $panVerificationResponse = $verifyPanCard->verifyPAN($kycData['pan_number'], $user->phone_number);

    //     // if ($panVerificationResponse['status'] === 'success') {
    //     //     // PAN verification successful
    //     //     if ($user->kyc) {
    //     //         dd("success");
    //     //         $user->kyc->update($kycData);
    //     //     } else {
    //     //         $user->kyc()->create($kycData);
    //     //     }
    
    //     //     return redirect()->back()->with('success', 'KYC details updated successfully.');
    //     // } else {
    //     //     dd("faill");
    //     //     // PAN verification failed
    //     //     return redirect()->back()->with('error', 'PAN verification failed.');
    //     // }
    // }

    //API
    public function ProfileupdateKyc(Request $request)
    {
        $request->validate([
            'aadhar_number' => 'required|digits:12|unique:user_kycs,aadhar_number,' . auth()->id() . ',user_id',
            'pan_number' => 'required|regex:/^[A-Z0-9]{10}$/|unique:user_kycs,pan_number,' . auth()->id() . ',user_id',
            'account_number' => 'required|regex:/^\d{11,16}$/',
            'ifsc_code' => 'required|regex:/^[A-Z0-9]{11}$/',
        ]);
        
        $user = auth()->user();
    
        $kycData = [
            'aadhar_number' => $request->input('aadhar_number'),
            'pan_number' => $request->input('pan_number'),
            'account_number' => $request->input('account_number'),
            'ifsc_code' => $request->input('ifsc_code'),
            'is_verified' => false, 
        ];
    
        // PAN Verification
        $verifyPanCard = new \App\Services\VerifyPanCard();
        $panVerificationResponse = $verifyPanCard->verifyPAN($kycData['pan_number'], $user->phone_number);
        // dd($panVerificationResponse);
        if ($panVerificationResponse['status'] !== 'success') {
            return redirect()->back()->with('error', 'PAN verification failed.');
        }
    
        // Bank Account Verification
        $verifyBankAccount = new \App\Services\VerifyBankAccount();
        $bankAccountResponse = $verifyBankAccount->verifyBankDetails($kycData['account_number'], $kycData['ifsc_code'], $user->phone_number);
    
        if ($bankAccountResponse['status'] !== 'success') {
            return redirect()->back()->with('error', 'Bank account verification failed.');
        }
        
        // dd($bankAccountResponse,$panVerificationResponse);
        // If both verifications are successful
        $kycData['is_verified'] = true;
        
        if ($user->kyc) {
            // dd('suceess',$kycData);
            $user->kyc->update($kycData);
        } else {
            // dd('suceess',$kycData);
            $user->kyc()->create($kycData);
        }
    
        return redirect()->back()->with('success', 'KYC details updated successfully.');
    }
    

    // public function ProfileupdateKyc(Request $request)
    // {
    //     $user = auth()->user();
    //     $userId = $user->id;
    //     // $userId = $user->kyc->user_id;
    //     $kycData = [
    //         'user_id' => $userId,
    //         'aadhar_number' => $request->input('aadhar_number'),
    //         'pan_number' => $request->input('pan_number'),
    //         'account_number' => $request->input('account_number'),
    //         'ifsc_code' => $request->input('ifsc_code'),
    //         'is_verified' => true, 
    //     ];   
    //     // API Integration
    //     //PanCard
    //     $verifyPanCard = new \App\Services\VerifyPanCard();
    //     $panVerificationResponse = $verifyPanCard->verifyPAN($kycData['pan_number'], $user->phone_number);
    //        //PAN CARD
    //        if($panVerificationResponse['status'] === 'success') {
    //         if ($user->kyc) {
    //             // dd('success');
    //             $user->kyc->update($kycData);
    //         } else {
    //             $user->kyc()->create($kycData);
    //         }
            
    //         return redirect()->back()->with('panVerificationsuccess', $panVerificationResponse['message']);
    //     } else {
    //         // dd('faill');
    //         // dd($panVerificationResponse);
    //         return redirect()->back()->with('panVerificationerror',$panVerificationResponse['message']);
    //     }

    //     //BankAccount API
    //     $verifyBankAccount = new \App\Services\VerifyBankAccount();
    //     $BankAccountResponse = $verifyBankAccount->verifyBankDetails($kycData['account_number'],$kycData['ifsc_code'], $user->phone_number,$userId);
    //     //BANK ACCOUNT
    //     if($BankAccountResponse['status'] === 'success') {
    //         dd('hi');
    //         if ($user->kyc) {
    //             dd('success');
    //             $user->kyc->update($kycData);
    //         } else {
    //             $user->kyc()->create($kycData);
    //         }
            
    //         return redirect()->back()->with('BankAccountsuccess', $panVerificationResponse['message']);
    //     } else {
    //         // dd('faill');
    //         // dd($panVerificationResponse);
    //         return redirect()->back()->with('BankAccounterror',$panVerificationResponse['message']);
    //     }
    // }
    

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

    public function ManagerCreateShow(Request $request)
    {
        $user = auth()->user();
        // $userKyc = auth()->userKyc();
        return view('backend.pages.Manager.managercreate', compact('user'));  
    }
    public function ManagerCreateStore(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|unique:users,phone_number',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:field_manager,relation_manager' 
        ], [
            'email.unique' => 'The email address is already taken.',
            'phone_number.unique' => 'The phone number is already taken.',
            'password.confirmed' => 'Password confirmation does not match.',
            'role.required' => 'Please select a role.',
            'role.in' => 'Please select a valid role.'
        ]);

        // Create user record in database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone_number'],
            'password' => Hash::make($validatedData['password']),
            'user_type' => $validatedData['role']
        ]);
        // dd($user);

        return redirect()->back()->with('success', 'Manager created successfully!');
    }
    public function ManagerShow(Request $request)
    {
        $users = User::all(); // Fetch users from database or any other method
        return view('backend.pages.Manager.managershow', compact('users'));  
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
            'reason' => 'nullable|string|max:255',
        ]);

        $userKyc = UserKyc::where('user_id', $userId)->firstOrFail();
        $userKyc->is_verified = $validatedData['is_verified'];

        if ($validatedData['is_verified'] == 1) {
            $userKyc->status = 'Verified';
            $userKyc->reason = null;
        } else {
            $userKyc->status = 'Rejected';
            $userKyc->reason = isset($validatedData['reason']) ? $validatedData['reason'] : null;
        }

        $userKyc->save();

        return redirect()->back()->with('success', 'KYC verification status updated successfully.');
    }

    public function CustomerKYCReson(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'reason' => 'nullable|string|max:255',
        ]);

        $userKyc = UserKyc::where('user_id', $userId)->firstOrFail();
        $userKyc->reason = $validatedData['reason'] ?? '';

        $userKyc->save();

        return redirect()->back()->with('success', 'Reason updated successfully.');
    }

    public function CustomerLoan()
    {
        // $users = auth()->user();
        // $users = \App\Models\User::all();
        // $loan = Loan::all(); 
        // $users = UsersLoan::all(); 
        $usersLoans = UsersLoan::with('user', 'Loan')->get();
        // dd($usersLoans);
        return view('backend.pages.customer.customerloan', compact('usersLoans'));
    }
}
