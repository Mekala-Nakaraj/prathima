<?php

namespace App\Http\Controllers\api\;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\UsersLoan;
use App\Services\AadhaarVerification;
use App\Services\LoanService;
use App\Services\VerifyBankAccount;
use App\Services\VerifyPanCard;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\UserKyc;
use App\Models\User;


class UserLoanController extends Controller
{
    protected $loanService;

    protected $panVerify;
    protected $bankVerify;
    protected $aadhaarVerify;

    public function __construct(LoanService $loanService, VerifyPanCard $panVerify, VerifyBankAccount $bankVerify, AadhaarVerification $aadhaarVerify)
    {
        $this->loanService = $loanService;
        $this->panVerify = $panVerify;
        $this->bankVerify = $bankVerify;
        $this->aadhaarVerify = $aadhaarVerify;
    }

    public function user_kyc(Request $request)
    {
        try {
            $user = Auth::user();

            $data = $request->all();
            $data['user_id'] = $user->id;

            $result = $this->loanService->kyc($data);

            return response()->json([
                'success' => 'KYC Uploaded',
                'result' => true
            ], 200);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function pan_verify(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 400);
            }

            $panNumber = $request->input('pan_number');
            $phoneNumber = $request->input('phone_number');

            $result = $this->panVerify->verifyPAN($panNumber, $phoneNumber, $user->id);

            return response()->json(['success' => $result], 200);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function bank_verify(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 400);
            }

            $accountNumber = $request->input('account_number');
            $ifscCode = $request->input('ifsc_code');
            $phoneNumber = $request->input('phone_number');

            $result = $this->bankVerify->verifyBankDetails($accountNumber, $ifscCode, $phoneNumber, $user->id);

            return response()->json(['success' => $result], 200);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function aadhaar_verify(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 400);
            }

            $aadharNumber = $request->input('aadhaar_number');

            $result = $this->aadhaarVerify->sendOtp($aadharNumber);

            return response()->json($result, 200);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function aadhaar_otp(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 400);
            }

            $otp = $request->input('otp');
            $reference_id = $request->input('reference_id');

            $result = $this->aadhaarVerify->verifyOtp($reference_id, $otp, $user->id);

            return response()->json($result, 200);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function edit_kyc(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                throw new \Exception('User not authenticated.');
            }

            $userKyc = UserKyc::where('user_id', $user->id)->first();

            if (!$userKyc) {
                throw new \Exception('User KYC record not found.');
            }

            return response()->json(['success' => $userKyc], 200);

        } catch (\Exception $e) {

            \Log::error('Error in edit_kyc method: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to retrieve or update KYC data.'], 500);
        }
    }


    public function update_kyc(Request $request)
    {
        try {
            $user = Auth::user();

            $data = $request->all();
            \Log::info('Update KYC Request Data:', $data);

            $userKyc = UserKyc::where('user_id', $user->id)->first();
            if (!$userKyc) {
                throw new \Exception('User KYC record not found.');
            }

            $result = $this->loanService->updateKyc($data, $userKyc);

            return response()->json(['success' => $result['success']], 200);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function kyc_status(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                throw new \Exception('User not authenticated.');
            }

            $userKyc = UserKyc::where('user_id', $user->id)->first();

            if (!$userKyc) {
                throw new \Exception('User KYC record not found.');
            }

            if ($userKyc->status == "rejected") {
                return response()->json(['reason' => $userKyc->reason, 'message' => 'rejected', 'status' => 3], 200);
            } elseif ($userKyc->is_verified == 1) {
                // KYC is verified
                return response()->json(['reason' => $userKyc->reason, 'message' => 'verified', 'status' => 2], 200);
            } else {
                // KYC is not verified
                return response()->json(['reason' => $userKyc->reason ?? '', 'message' => 'un_verify', 'status' => 1], 200);
            }


        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error in kyc_status method: ' . $e->getMessage());

            return response()->json(['message' => $e->getMessage(), 'status' => 0], 500);
        }
    }


    public function edit_user(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                throw new \Exception('User not authenticated.');
            }

            $userKyc = User::where('id', $user->id)->first();

            if (!$userKyc) {
                throw new \Exception('User KYC record not found.');
            }

            return response()->json(['success' => $userKyc], 200);

        } catch (\Exception $e) {

            \Log::error('Error in edit_kyc method: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to retrieve or update KYC data.'], 500);
        }
    }
    public function user_update(Request $request)
    {
        try {
            $user = Auth::user();

            $data = $request->all();

            $user = User::where('id', $user->id)->first();
            //  dd($user);
            if (!$user) {
                throw new \Exception('User KYC record not found.');
            }

            $result = $this->loanService->updateuser($data, $user);

            return response()->json(['success' => $result], 200);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function loan_amount()
    {
        try {
            $user = Auth::user();

            $loan_amount = Settings::where('key', 'initial_loan_amount')->value('value');

            return response()->json(['data' => $loan_amount, 'status' => true], 200);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function loan_details(Request $request)
    {
        $user = Auth::user();
        dd("ji");



    }



}
