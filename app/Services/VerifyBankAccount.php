<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\User;

class VerifyBankAccount 
{
    public function verifyBankDetails($accountNumber, $ifscCode, $phoneNumber,$user = null)
    {
        $url = "https://api.eko.in:25002/ekoicici/v2/banks/ifsc:$ifscCode/accounts/$accountNumber";
        $developerKey = '793db230ef4ac2eb691e3087f73fe749';
        $secretKey = 'y4k0KzCD1cCfUNnOqz7WsshrduUZC51YH61sxj8zxdM=';
        $secretKeyTimestamp = '1704791808198';

        // $customerId = $this->generateCustomerId($phoneNumber);
        $customerId = '7708325543';
        // $userCode = $this->generateUserCode();
        $userCode = '34870001';
        $initiator_id = '7708080885';

        $response = Http::asForm()->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'developer_key' => $developerKey,
            'secret-key' => $secretKey,
            'secret-key-timestamp' => $secretKeyTimestamp,
        ])->post($url, [
            'account_number' => $accountNumber,
            'ifsc_code' => $ifscCode,
            'initiator_id' => $initiator_id,
            'customer_id' => $customerId,
            'client_ref_id' => 'AVS20181123194719311',
            'user_code' => $userCode,
        ]);

        $responseBody = $response->json();
        // dd($url);
        // dd("API Response verifyBankDetails", $responseBody);

        if ($response->successful() && $responseBody['status'] == 0) {
            $user = User::where("id", $user)->first();
            $user->bank_verified = 1;
            $user->save();
            return [
                'status' => 'success',
                'message' => 'Bank details verified successfully.',
                'response' => $responseBody,
            ];
        } else {
            // $errorMessage = isset($responseBody['message']) ? $responseBody['message'] : 'Bank details verification failed.';
            return [
                'status' => 'error',
                'message' => 'Bank details verification failed.',
                // 'error' => $responseBody,
            ];
        }
    }

    private function generateCustomerId($phoneNumber)
    {
        return 'CUST' . $phoneNumber . time();
    }

    private function generateUserCode()
    {
        return 'USER' . time();
    }
}
