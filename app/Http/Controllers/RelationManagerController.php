<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserKyc;

class RelationManagerController extends Controller
{
    public function RelationManagerShow()
    {
        return view('backend.dashboard');
    }
    public function RelationManagerCustomerKycShow()
    {  
        // $users = auth()->user();
        $users = \App\Models\User::all();
        $userskyc = \App\Models\UserKyc::all();
        // dd($users);
        return view('backend.pages.ManagerRelation.customerkyc', compact('users','userskyc'));
    }
     public function updateRelationManagerVerification(Request $request, $userId)
    {

        $validatedData = $request->validate([
            'relationship_manager_verified' => 'required|boolean',
            'reason' => 'nullable|string|max:255',
        ]);
    
        $userKyc = UserKyc::where('user_id', $userId)->firstOrFail();
    
        $userKyc->relationship_manager_verified = $validatedData['relationship_manager_verified'];
    
        if ($validatedData['relationship_manager_verified'] == 0 && isset($validatedData['reason'])) {
            $userKyc->reason = $validatedData['reason'];
        } else {
            $userKyc->reason = null; 
        }
    
        // Update is_verified field
        $userKyc->is_verified = ($userKyc->relationship_manager_verified == 1 && $userKyc->relationship_manager_verified == 1);
        // dd($userKyc);
        // dd($validatedData);
        $userKyc->save();
    
        return redirect()->back()->with('success', 'Field Manager verification status updated successfully.');
    }
}
