<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserKyc;
use App\Models\Loan;
use App\Models\UsersLoan;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function LoanDeatilsShow($id)
    {
        $user = User::findOrFail($id);
        // dd($user);
        return view('backend.pages.customer.loandeatails', compact('user'));
    }
    // public function LoanDeatilsstore(Request $request, User $user)
    // {
    //     $request->validate([
    //         'agreement' => 'required|string|max:255',
    //         'interest_rate' => 'required|numeric|min:0',
    //         'due_date' => 'required|date',
    //         'approved_loan_amount' => 'required|numeric|min:0',
    //     ]);
    
    //     $loanData = [
    //         'agreement' => $request->input('agreement'),
    //         'interest_rate' => $request->input('interest_rate'),
    //         'approved_loan_amount' => $request->input('approved_loan_amount'),
    //     ];
    
    //     // Check if start_date is provided, otherwise use current date
    //     if ($request->has('start_date')) {
    //         $loanData['start_date'] = $request->input('start_date');
    //     } else {
    //         $loanData['start_date'] = now()->toDateString(); 
    //     }
    
    //     // Explicitly set due_date from request
    //     $loanData['due_date'] = $request->input('due_date');
    
    //     // Update or create loan record
    //     $user->loan()->updateOrCreate([], $loanData);
    
    //     return redirect()->back()->with('success', 'Loan details updated successfully.');
    // }
    // public function LoanDeatilsstore(Request $request, User $user)
    // {
    //     $request->validate([
    //         'agreement' => 'required|string|max:255',
    //         'interest_rate' => 'required|array|min:1',
    //         'interest_rate.*' => 'required|string',
    //         'due_date' => 'required|array|min:1',
    //         'due_date.*' => 'required|integer',
    //         'approved_loan_amount' => 'required|numeric|min:0',
    //     ]);

    //     $loanData = [
    //         'interest_rate' => json_encode($request->input('interest_rate')), 
    //         'due_date' => json_encode($request->input('due_date')), 
    //         'agreement' => $request->input('agreement'),
    //         'start_date' => $request->input('start_date'),
    //         'approved_loan_amount' => $request->input('approved_loan_amount'),
    //     ];

    //     if ($request->has('start_date')) {
    //         $startDate = Carbon::parse($request->input('start_date'));
    //     } else {
    //         $startDate = Carbon::now();
    //     }
    //     // $loanData['start_date'] = $startDate->toDateString(); 

    //     $dueDates = array_map(function($days) use ($startDate) {
    //         return $startDate->copy()->addDays($days)->toDateString();
    //     }, $request->input('due_date'));

    //     // $loanData['due_date'] = json_encode($dueDates);

    //     // dd($loanData);
    //     $user->loan()->updateOrCreate([], $loanData);

    //     return redirect()->back()->with('success', 'Loan details updated successfully.');
    // }
    public function LoanDeatilsstore(Request $request, User $user)
    {   
        // Validate incoming data
        $request->validate([
            'start_date' => 'required|date',
            'approved_loan_amount' => 'required|numeric',
            'interest_rate.*' => 'required|numeric',
            'due_date.*' => 'required',
            'agreement' => 'required|string',
        ]);

        $interestRateDueDate = [];

        foreach ($request->interest_rate as $index => $interestRate) {
            $interestRateDueDate[] = [
                'interest_rate' => $interestRate,
                'due_date' => $request->due_date[$index]
            ];
        }

        $dueDateInterestRateJson = json_encode($interestRateDueDate);

        $loanData = [
            'start_date' => $request->input('start_date'),
            'approved_loan_amount' => $request->input('approved_loan_amount'),
            'due_date_interest_rate' => $dueDateInterestRateJson,
            'agreement' => $request->input('agreement'),
        ];

        // dd($loanData);

        $user->loan()->updateOrCreate(
            ['loan_id' => $user->id], 
            $loanData 
        );
        
        return redirect()->back()->with('success', 'Loan details updated successfully.');
    }

    // public function ProfileDeatilsShow($id)
    // {
    //     $userLoan = UsersLoan::with('user', 'loan', 'UserKyc')->where('user_id', $id)->firstOrFail();
    //     // $user = User::findOrFail($id);
    //     return view('backend.pages.customer.alldetailsshow', compact('userLoan'));
    // }
   
    // public function ProfileDeatilsShow($id)
    // {
    //     $userLoan = UsersLoan::with('user', 'loan', 'UserKyc')->where('user_id', $id)->firstOrFail();

    //     if (!$userLoan->loan || empty($userLoan->loan->user_due_date_interest_rate)) {
    //         return view('backend.pages.customer.alldetailsshow', compact('userLoan'));
    //     }

    //     $dueDateInterestRates = json_decode($userLoan->loan->user_due_date_interest_rate, true);
    //     $calculatedDueDates = [];
    //     $totalInterest = 0;

    //     foreach ($dueDateInterestRates as $detail) {
    //         $startDate = new \DateTime($userLoan->loan->start_date);
    //         $totalDays = $detail['due_date']; // Total term in days
    //         $interestRate = $detail['interest_rate']; // Annual interest rate

    //         if ($totalDays <= 0) {
    //             continue; // Skip invalid terms
    //         }

    //         $months = $totalDays / 30;
    //         if ($months <= 0) {
    //             continue; // Skip invalid terms
    //         }

    //         $annualInterestRate = $interestRate / 100;
    //         $monthlyInterestRate = $annualInterestRate / 12;
    //         // dd($totalInterest);

    //         // EMI Calculation using the formula: E = P * r * (1 + r)^n / ((1 + r)^n - 1)
    //         if ($monthlyInterestRate == 0) {
    //             $emi = $userLoan->loan->approved_loan_amount / $months;
    //         } else {
    //             $emi = $userLoan->loan->approved_loan_amount * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $months) / (pow(1 + $monthlyInterestRate, $months) - 1);
    //         }

    //         $outstandingPrincipal = $userLoan->loan->approved_loan_amount;

    //         for ($i = 0; $i < $months; $i++) {
    //             $interest = $outstandingPrincipal * $monthlyInterestRate;
    //             $principal = $emi - $interest;
    //             $outstandingPrincipal -= $principal;
    //             $totalInterest += $interest;
    //             $calculatedDueDates[] = [
    //                 'due_date' => $startDate->format('Y-m-d'),
    //                 'emi' => round($emi, 2),
    //                 'principal' => round($principal, 2),
    //                 'interest' => round($interest, 2),
    //                 'outstanding_principal' => round($outstandingPrincipal, 2)
    //             ];

    //             $startDate->modify('+30 days');
    //         }
    //     }

    //     $lastDueDate = end($calculatedDueDates)['due_date'] ?? 'NA';
    //     // dd($lastDueDate);

    //     return view('backend.pages.customer.alldetailsshow', compact('userLoan', 'calculatedDueDates', 'lastDueDate', 'totalInterest'));
    // }

    // public function ProfileDeatilsShow($id)
    // {
    //     $userLoan = UsersLoan::with('user', 'loan', 'UserKyc')->where('user_id', $id)->firstOrFail();
    
    //     if (!$userLoan->loan || empty($userLoan->loan->user_due_date_interest_rate)) {
    //         return view('backend.pages.customer.alldetailsshow', compact('userLoan'));
    //     }
    
    //     $dueDateInterestRates = json_decode($userLoan->loan->user_due_date_interest_rate, true);
    //     $calculatedDueDates = [];
    //     $totalInterest = 0;
    
    //     foreach ($dueDateInterestRates as $detail) {
    //         $startDate = new \DateTime($userLoan->loan->start_date);
    //         $totalDays = $detail['due_date']; 
    //         $annualInterestRate = $detail['interest_rate']; 
    
    //         if ($totalDays <= 0) {
    //             continue; 
    //         }
    
    //         $months = $totalDays / 30;
    //         if ($months <= 0) {
    //             continue; 
    //         }
    
    //         // Convert annual interest rate to effective rate for the given term
    //         $effectiveMonthlyInterestRate = pow((1 + ($annualInterestRate / 100)), (1 / 12)) - 1;
    
    //         // EMI Calculation using the formula: E = P * r * (1 + r)^n / ((1 + r)^n - 1)
    //         if ($effectiveMonthlyInterestRate == 0) {
    //             $emi = $userLoan->loan->approved_loan_amount / $months;
    //         } else {
    //             $emi = $userLoan->loan->approved_loan_amount * $effectiveMonthlyInterestRate * pow(1 + $effectiveMonthlyInterestRate, $months) / (pow(1 + $effectiveMonthlyInterestRate, $months) - 1);
    //         }
    
    //         $outstandingPrincipal = $userLoan->loan->approved_loan_amount;
    
    //         for ($i = 0; $i < $months; $i++) {
    //             $interest = $outstandingPrincipal * $effectiveMonthlyInterestRate;
    //             $principal = $emi - $interest;
    //             $outstandingPrincipal -= $principal;
    //             $totalInterest += $interest;
    //             $calculatedDueDates[] = [
    //                 'due_date' => $startDate->format('Y-m-d'),
    //                 'emi' => round($emi, 2),
    //                 'principal' => round($principal, 2),
    //                 'interest' => round($interest, 2),
    //                 'outstanding_principal' => round($outstandingPrincipal, 2)
    //             ];
    
    //             $startDate->modify('+30 days');
    //         }
    //     }
    
    //     $lastDueDate = end($calculatedDueDates)['due_date'] ?? 'NA';
    
    //     return view('backend.pages.customer.alldetailsshow', compact('userLoan', 'calculatedDueDates', 'lastDueDate', 'totalInterest'));
    // }

    // public function ProfileDeatilsShow($id)
    // {
    //     $userLoan = UsersLoan::with('user', 'loan', 'UserKyc')->where('user_id', $id)->firstOrFail();

    //     if (!$userLoan->loan || empty($userLoan->loan->user_due_date_interest_rate)) {
    //         return view('backend.pages.customer.alldetailsshow', compact('userLoan'));
    //     }

    //     $dueDateInterestRates = json_decode($userLoan->loan->user_due_date_interest_rate, true);
    //     $calculatedDueDates = [];
    //     $totalInterest = 0;

    //     foreach ($dueDateInterestRates as $detail) {
    //         $startDate = new \DateTime($userLoan->loan->start_date);
    //         $totalDays = $detail['due_date']; 
    //         $annualInterestRate = $detail['interest_rate']; 

    //         if ($totalDays <= 0) {
    //             continue; 
    //         }

    //         $months = $totalDays / 30;
    //         if ($months <= 0) {
    //             continue; 
    //         }

    //         // Total Repayment Amount
    //         $principal = $userLoan->loan->approved_loan_amount;
    //         $totalRepaymentAmount = $principal * (1 + ($annualInterestRate / 100));
    //         dd($totalRepaymentAmount);
    //         // Convert annual interest rate to monthly rate
    //         $monthlyInterestRate = ($annualInterestRate / 100) / 12;

    //         // Calculate EMI
    //         if ($monthlyInterestRate == 0) {
    //             $emi = $totalRepaymentAmount / $months;
    //         } else {
    //             $emi = $totalRepaymentAmount * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $months) / (pow(1 + $monthlyInterestRate, $months) - 1);
    //         }

    //         $outstandingPrincipal = $principal;

    //         for ($i = 0; $i < $months; $i++) {
    //             $interest = $outstandingPrincipal * $monthlyInterestRate;
    //             $principalPayment = $emi - $interest;
    //             $outstandingPrincipal -= $principalPayment;
    //             $totalInterest += $interest;
    //             $calculatedDueDates[] = [
    //                 'due_date' => $startDate->format('Y-m-d'),
    //                 'emi' => round($emi, 2),
    //                 'principal' => round($principalPayment, 2),
    //                 'interest' => round($interest, 2),
    //                 'outstanding_principal' => round($outstandingPrincipal, 2)
    //             ];

    //             $startDate->modify('+30 days');
    //         }
    //     }

    //     $lastDueDate = end($calculatedDueDates)['due_date'] ?? 'NA';

    //     return view('backend.pages.customer.alldetailsshow', compact('userLoan', 'calculatedDueDates', 'lastDueDate', 'totalInterest'));
    // }

//     public function ProfileDeatilsShow($id)
// {
//     $userLoan = UsersLoan::with('user', 'loan', 'UserKyc')->where('user_id', $id)->firstOrFail();

//     if (!$userLoan->loan || empty($userLoan->loan->user_due_date_interest_rate)) {
//         return view('backend.pages.customer.alldetailsshow', compact('userLoan'));
//     }

//     $dueDateInterestRates = json_decode($userLoan->loan->user_due_date_interest_rate, true);
//     $calculatedDueDates = [];
//     $totalInterest = 0;

//     foreach ($dueDateInterestRates as $detail) {
//         $startDate = new \DateTime($userLoan->loan->start_date);
//         $totalDays = $detail['due_date'];
//         $annualInterestRate = $detail['interest_rate'];

//         if ($totalDays <= 0) {
//             continue; // Skip invalid terms
//         }

//         $months = $totalDays / 30;
//         if ($months <= 0) {
//             continue; // Skip invalid terms
//         }

//         // Convert annual interest rate to effective monthly interest rate
//         $principal = $userLoan->loan->approved_loan_amount;
//         $totalRepaymentAmount = $principal * (1 + ($annualInterestRate / 100));
//         // $monthlyInterestRate = ($annualInterestRate / 100) / 12;
//         $monthlyInterestRate = ($annualInterestRate / 100) / 12;
//         // dd($monthlyInterestRate);

//         // Calculate EMI using the formula: E = P * r * (1 + r)^n / ((1 + r)^n - 1)
//         $principal = $userLoan->loan->approved_loan_amount;
//         if ($monthlyInterestRate == 0) {
//             $emi = $principal / $months;
//         } else {
//             $emi = $principal * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $months) / (pow(1 + $monthlyInterestRate, $months) - 1);
//         }

//         $outstandingPrincipal = $principal;
//         // dd($outstandingPrincipal);

//         for ($i = 0; $i < $months; $i++) {
//             $interest = $outstandingPrincipal * $monthlyInterestRate;
//             $principalPayment = $emi - $interest;
//             $outstandingPrincipal -= $principalPayment;
//             $totalInterest += $interest;

//             $calculatedDueDates[] = [
//                 'due_date' => $startDate->format('Y-m-d'),
//                 'emi' => round($emi, 2),
//                 'principal' => round($principalPayment, 2),
//                 'interest' => round($interest, 2),
//                 'outstanding_principal' => round($outstandingPrincipal, 2)
//             ];

//             $startDate->modify('+30 days');
//         }
//     }

//     $lastDueDate = end($calculatedDueDates)['due_date'] ?? 'NA';

//     return view('backend.pages.customer.alldetailsshow', compact('userLoan', 'calculatedDueDates', 'lastDueDate', 'totalInterest'));
// }

/* curret */
// public function ProfileDeatilsShow($id)
// {
//     $userLoan = UsersLoan::with('user', 'loan', 'UserKyc')->where('user_id', $id)->firstOrFail();
    
//     $principal = $userLoan->loan->approved_loan_amount;
//     // dd($principal);
//     $totalInterest = 100;
//     $totalRepayment = $principal + $totalInterest;
//     $loanDuration = 5; 
//     $emi = $totalRepayment / $loanDuration;

//     $outstandingPrincipal = $principal;
//     $emiDetails = [];

//     // Calculate EMI details for each month
//     for ($month = 1; $month <= $loanDuration; $month++) {
//         $interest = ($principal * 10 / 100) / $loanDuration; 
//         $principalRepayment = $emi - $interest;
//         $outstandingPrincipal -= $principalRepayment;

//         $dueDate = Carbon::now()->addMonths($month)->format('Y-m-d');

//         $emiDetails[] = [
//             'due_date' => $dueDate,
//             'emi' => $emi,
//             'principal' => $principalRepayment,
//             'interest' => $interest,
//             'outstanding_principal' => max($outstandingPrincipal, 0),
//         ];
//     }

//     return view('backend.pages.customer.alldetailsshow', [
//         'userLoan' => $userLoan,
//         'principal' => $principal,
//         'total_interest' => $totalInterest,
//         'total_repayment' => $totalRepayment,
//         'loan_duration' => $loanDuration,
//         'emi' => $emi,
//         'emi_details' => $emiDetails,
//     ]);
// }

// public function ProfileDeatilsShow($id)
// {
//     $userLoan = UsersLoan::with('user', 'loan', 'UserKyc')->where('user_id', $id)->firstOrFail();
    
//     $principal = $userLoan->loan->approved_loan_amount;
//     $totalInterestRate = isset($loanDetails[0]['interest_rate']) ? (float)$loanDetails[0]['interest_rate'] : 10.0;
//     $totalInterest = ($principal * $totalInterestRate / 100);
//     $totalRepayment = $principal + $totalInterest;
//     $loanDuration =isset($loanDetails[0]['due_date']) ? (int)$loanDetails[0]['due_date'] : 5;
//     $emi = $totalRepayment / $loanDuration;
//     $outstandingPrincipal = $principal;
//     $emiDetails = [];


//     // dd($totalInterest);


//     // Calculate EMI details for each month
//     for ($month = 1; $month <= $loanDuration; $month++) {
//         $interest = ($principal * 10 / 100) / $loanDuration; 
//         $principalRepayment = $emi - $interest;
//         $outstandingPrincipal -= $principalRepayment;

//         $dueDate = Carbon::now()->addMonths($month)->format('Y-m-d');

//         $emiDetails[] = [
//             'due_date' => $dueDate,
//             'emi' => $emi,
//             'principal' => $principalRepayment,
//             'interest' => $interest,
//             'outstanding_principal' => max($outstandingPrincipal, 0),
//         ];
//     }

//     return view('backend.pages.customer.alldetailsshow', [
//         'userLoan' => $userLoan,
//         'principal' => $principal,
//         'total_interest' => $totalInterest,
//         'total_repayment' => $totalRepayment,
//         'loan_duration' => $loanDuration,
//         'emi' => $emi,
//         'emi_details' => $emiDetails,
//     ]);
// }


/* kgy */
// public function ProfileDeatilsShow($id)
// {
//     $userLoan = UsersLoan::with('user', 'loan', 'UserKyc')->where('user_id', $id)->firstOrFail();
    
//     $principal = $userLoan->loan->approved_loan_amount;

//     $totalInterestRate = isset($userLoan->loan->interest_rate) && is_numeric($userLoan->loan->interest_rate) ? (float)$userLoan->loan->interest_rate : 10.0;
//     $loanDetails = json_decode($userLoan->loan->user_due_date_interest_rate, true);

//     $totalInterest = ($principal * $totalInterestRate / 100);
//     $totalRepayment = $principal + $totalInterest;

//     $loanDuration = isset($userLoan->loan->due_date) ? (int)$userLoan->loan->due_date : 5;
//     $emi = $loanDuration > 0 ? $totalRepayment / $loanDuration : 0;
//     dd($loanDuration);
//     $outstandingPrincipal = $principal;
//     $emiDetails = [];

//     // Calculate EMI details for each month
//     for ($month = 1; $month <= $loanDuration; $month++) {
//         $interest = ($principal * $totalInterestRate / 100) / $loanDuration; 
//         $principalRepayment = $emi - $interest;
//         $outstandingPrincipal -= $principalRepayment;
//         $outstandingPrincipal = max($outstandingPrincipal, 0);

//         $dueDate = Carbon::now()->addMonths($month)->format('Y-m-d');

//         $emiDetails[] = [
//             'due_date' => $dueDate,
//             'emi' => round($emi, 2),
//             'principal' => round($principalRepayment, 2),
//             'interest' => round($interest, 2),
//             'outstanding_principal' => round($outstandingPrincipal, 2),
//         ];
//     }

//     return view('backend.pages.customer.alldetailsshow', [
//         'userLoan' => $userLoan,
//         'principal' => $principal,
//         'total_interest' => $totalInterest,
//         'total_repayment' => $totalRepayment,
//         'loan_duration' => $loanDuration,
//         'emi' => round($emi, 2),
//         'emi_details' => $emiDetails,
//     ]);
// }

public function ProfileDeatilsShow($id)
{
    $userLoan = UsersLoan::with('user', 'loan', 'UserKyc')->where('user_id', $id)->firstOrFail();

    $principal = $userLoan->loan->approved_loan_amount;

    // Extract interest rate from JSON field
    $loanDetails = json_decode($userLoan->loan->user_due_date_interest_rate, true);
    $totalInterestRate = isset($loanDetails[0]['interest_rate']) && is_numeric($loanDetails[0]['interest_rate']) ? (float)$loanDetails[0]['interest_rate'] : 0;
    $totalInterest = ($principal * $totalInterestRate / 100);
    $totalRepayment = $principal + $totalInterest;

    $loanDuration =  isset($loanDetails[0]['due_date']) && is_numeric($loanDetails[0]['due_date']) ? (float)$loanDetails[0]['due_date'] : 0;;
    $emi = $loanDuration > 0 ? $totalRepayment / $loanDuration : 0;

    $outstandingPrincipal = $principal;
    $emiDetails = [];
    $currentMonth = Carbon::now()->format('Y-m');

    // Calculate EMI details for each month
    for ($month = 1; $month <= $loanDuration; $month++) {
        $interest = ($principal * $totalInterestRate / 100) / $loanDuration; 
        $principalRepayment = $emi - $interest;
        $outstandingPrincipal -= $principalRepayment;
        $outstandingPrincipal = max($outstandingPrincipal, 0);

        $dueDate = Carbon::now()->addMonths($month)->format('Y-m-d');
        $formattedMonth = Carbon::parse($dueDate)->format('Y-m');

        $emiDetails[] = [
            'due_date' => $dueDate,
            'emi' => round($emi, 2),
            'principal' => round($principalRepayment, 2),
            'interest' => round($interest, 2),
            'outstanding_principal' => round($outstandingPrincipal, 2),
            'is_current' => $formattedMonth === $currentMonth,
        ];
    }

    $profit = $totalRepayment - $principal ;
 
    return view('backend.pages.customer.alldetailsshow', [
        'userLoan' => $userLoan,
        'principal' => $principal,
        'total_interest' => $totalInterest,
        'total_repayment' => $totalRepayment,
        'loan_duration' => $loanDuration,
        'emi' => round($emi, 2),
        'emi_details' => $emiDetails,
        'profit' => $profit,
    ]);
}














    



    






















// public function ProfileDeatilsShow($id)
// {
//     $userLoan = UsersLoan::with('user', 'loan', 'UserKyc')->where('user_id', $id)->firstOrFail();

//     if (!$userLoan->loan || empty($userLoan->loan->user_due_date_interest_rate)) {
//         return view('backend.pages.customer.alldetailsshow', compact('userLoan'));
//     }

//     $dueDateInterestRates = json_decode($userLoan->loan->user_due_date_interest_rate, true);
//     $calculatedDueDates = [];
//     $totalInterest = 0;

//     foreach ($dueDateInterestRates as $detail) {
//         $startDate = new \DateTime($userLoan->loan->start_date);
//         $totalDays = $detail['due_date']; // Total term in days
//         $monthlyInterestRate = $detail['interest_rate'] / 100; // Monthly interest rate

//         if ($totalDays <= 0) {
//             continue; // Skip invalid terms
//         }

//         $months = ceil($totalDays / 30); // Convert days to months, using ceil to ensure full months

//         // EMI Calculation using the formula: E = P * r * (1 + r)^n / ((1 + r)^n - 1)
//         if ($monthlyInterestRate == 0) {
//             // For 0% interest rate, EMI is simply the principal divided by the number of months
//             $emi = $userLoan->loan->approved_loan_amount / $months;
//         } else {
//             // Calculate EMI
//             $emi = $userLoan->loan->approved_loan_amount * $monthlyInterestRate * pow(1 + $monthlyInterestRate, $months) / (pow(1 + $monthlyInterestRate, $months) - 1);
//         }

//         $outstandingPrincipal = $userLoan->loan->approved_loan_amount;

//         for ($i = 0; $i < $months; $i++) {
//             $interest = $outstandingPrincipal * $monthlyInterestRate;
//             $principal = $emi - $interest;
//             $outstandingPrincipal -= $principal;
//             $totalInterest += $interest;

//             $calculatedDueDates[] = [
//                 'due_date' => $startDate->format('Y-m-d'),
//                 'emi' => round($emi, 2),
//                 'principal' => round($principal, 2),
//                 'interest' => round($interest, 2),
//                 'outstanding_principal' => round($outstandingPrincipal, 2)
//             ];

//             $startDate->modify('+30 days');
//         }
//     }

//     $lastDueDate = end($calculatedDueDates)['due_date'] ?? 'NA';

//     return view('backend.pages.customer.alldetailsshow', compact('userLoan', 'calculatedDueDates', 'lastDueDate', 'totalInterest'));
// }
       
}
