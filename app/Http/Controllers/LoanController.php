<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserKyc;
use App\Models\Loan;
use App\Models\UsersLoan;

class LoanController extends Controller
{
    public function LoanDeatilsShow($id)
    {
        $user = User::findOrFail($id);
        // dd($user);
        return view('backend.pages.customer.loandeatails', compact('user'));
    }
    public function LoanDeatilsstore(Request $request, User $user)
    {
        $request->validate([
            'agreement' => 'required|string|max:255',
            'interest_rate' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'approved_loan_amount' => 'required|numeric|min:0',
        ]);
    
        $loanData = [
            'agreement' => $request->input('agreement'),
            'interest_rate' => $request->input('interest_rate'),
            'approved_loan_amount' => $request->input('approved_loan_amount'),
        ];
    
        // Check if start_date is provided, otherwise use current date
        if ($request->has('start_date')) {
            $loanData['start_date'] = $request->input('start_date');
        } else {
            $loanData['start_date'] = now()->toDateString(); // Example of setting current date
        }
    
        // Explicitly set due_date from request
        $loanData['due_date'] = $request->input('due_date');
    
        // Update or create loan record
        $user->loan()->updateOrCreate([], $loanData);
    
        return redirect()->back()->with('success', 'Loan details updated successfully.');
    }
    public function ProfileDeatilsShow($id)
    {
        $userLoan = UsersLoan::with('user', 'loan', 'UserKyc')->where('user_id', $id)->firstOrFail();
        // $user = User::findOrFail($id);
        return view('backend.pages.customer.alldetailsshow', compact('userLoan'));
    }
    
}
