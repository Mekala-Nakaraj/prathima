<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserKyc;


class CustomerKYCController extends Controller
{
    public function updateRelationshipManagerVerification(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'relationship_manager_verified' => 'required|boolean',
            'reason' => 'nullable|string|max:255', 
        ]);

        $userKyc = UserKyc::where('user_id', $userId)->firstOrFail();

        $userKyc->relationship_manager_verified = $validatedData['relationship_manager_verified'];

        if (!$validatedData['relationship_manager_verified'] && isset($validatedData['reason'])) {
            $userKyc->reason = $validatedData['reason'];
        } else {
            $userKyc->reason = null; 
        }

        // Save the updated KYC record
        $userKyc->save();

        return redirect()->back()->with('success', 'Relationship Manager verification status updated successfully.');
    }
    public function CustomerKYCVerified(Request $request, $userId)
    {
        $validatedData = $request->validate([
            'is_verified' => 'required|boolean',
            'relationship_manager_verified' => 'required|boolean',
            'field_manager_verified' => 'required|boolean',
        ]);

        $userKyc = UserKyc::where('user_id', $userId)->firstOrFail();

        $userKyc->relationship_manager_verified = $validatedData['relationship_manager_verified'];
        $userKyc->field_manager_verified = $validatedData['field_manager_verified'];

 
        if ($validatedData['is_verified'] == 1) {
            $userKyc->status = 'Verified';
        } else {
            $userKyc->status = 'Rejected';
        }

        // Save the updated KYC record
        $userKyc->save();

        return redirect()->back()->with('success', 'KYC verification status updated successfully.');
    }
}
