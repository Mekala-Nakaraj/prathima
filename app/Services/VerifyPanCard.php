<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class VerifyPanCard 
{
    public function verifyPAN($panNumber, $phoneNumber)
    {   
        $url = "https://api.eko.in:25002/ekoicici/v1/pan/verify";
        $developerKey = '793db230ef4ac2eb691e3087f73fe749';
        $secretKey = 'y4k0KzCD1cCfUNnOqz7WsshrduUZC51YH61sxj8zxdM=';
        $secretKeyTimestamp = '1704791808198';

        $initiatorId = $phoneNumber;
        $purpose = '1';
        $purposeDesc = 'onboarding';

        $response = Http::asForm()->withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
            'developer_key' => $developerKey,
            'secret-key' => $secretKey,
            'secret-key-timestamp' => $secretKeyTimestamp,
        ])->post($url, [
            'pan_number' => $panNumber,
            'purpose' => $purpose,
            'initiator_id' => '7708080885',
            'purpose_desc' => $purposeDesc,
        ]);

        $responseBody = $response->json();
        dd($responseBody);

        if ($response->successful() && $responseBody['status'] == 0) {
            return [
                'status' => 'success',
                'message' => 'PAN verified successfully.',
                'response' => $responseBody,
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'PAN verification failed.',
                // 'error' => $responseBody,
            ];
        }
    }
}
