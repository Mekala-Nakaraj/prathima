<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserKyc;


use Illuminate\Http\Request;

class FieldManagerController extends Controller
{
    public function FieldManagerShow()
    {
        return view('backend.dashboard');
    }
    public function FiledManagerCustomerKycShow()
    {  
        // $users = auth()->user();
        $users = \App\Models\User::all();
        $userskyc = \App\Models\UserKyc::all();
        // dd($users);
        return view('backend.pages.ManagerField.customerkyc', compact('users','userskyc'));
    }
    public function updateFieldManagerVerification(Request $request, $userId)
    {

        $validatedData = $request->validate([
            'field_manager_verified' => 'required|boolean',
            'reason' => 'nullable|string|max:255',
        ]);
    
        $userKyc = UserKyc::where('user_id', $userId)->firstOrFail();
    
        $userKyc->field_manager_verified = $validatedData['field_manager_verified'];
    
        if ($validatedData['field_manager_verified'] == 0 && isset($validatedData['reason'])) {
            $userKyc->reason = $validatedData['reason'];
        } else {
            $userKyc->reason = null; 
        }
    
        // Update is_verified field
        $userKyc->is_verified = ($userKyc->relationship_manager_verified == 1 && $userKyc->field_manager_verified == 1);
    
        $userKyc->save();
    
        return redirect()->back()->with('success', 'Field Manager verification status updated successfully.');
    }
   
    
}
