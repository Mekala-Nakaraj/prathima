<?php

namespace App\Services;

use App\Models\Settings;
use App\Models\User;

class AadhaarVerification
{
    protected $SANDBOX_API_KEY;
    protected $SANDBOX_API_SECRET;
    protected $SANDBOX_API_VERSION;
    protected $SANDBOX_ACCESS_TOKEN;

    public function __construct()
    {
        $this->SANDBOX_API_KEY = Settings::where('key', 'sandbox_live_api_key')->value('value');
        $this->SANDBOX_API_SECRET = Settings::where('key', 'sandbox_secret_key')->value('value');
        $this->SANDBOX_API_VERSION = Settings::where('key', 'sandbox_version')->value('value');
        $this->SANDBOX_ACCESS_TOKEN = $this->authenticate();
    }

    protected function authenticate()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sandbox.co.in/authenticate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'x-api-key: ' . $this->SANDBOX_API_KEY,
                'x-api-secret: ' . $this->SANDBOX_API_SECRET,
                'x-api-version: ' . $this->SANDBOX_API_VERSION,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Exception("Authentication Error: " . $err);
        }

        $authResponse = json_decode($response, true);

        if (isset($authResponse['access_token'])) {
            return $authResponse['access_token'];
        } else {
            throw new \Exception("Failed to get access token");
        }
        
    }

    public function sendOtp($aadharNumber)
    {

        \Log::info("otp". $this->SANDBOX_ACCESS_TOKEN);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sandbox.co.in/kyc/aadhaar/okyc/otp',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "@entity" => "in.co.sandbox.kyc.aadhaar.okyc.otp.request",
                "aadhaar_number" => $aadharNumber,
                "reason" => "For KYC",
                "consent" => "y"
            )),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $this->SANDBOX_ACCESS_TOKEN,
                'x-api-key: ' . $this->SANDBOX_API_KEY,
                'x-api-version: ' . $this->SANDBOX_API_VERSION,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return json_encode(['error' => $err]);
        }

        return json_decode($response, true);
    }

    public function verifyOtp($referenceId, $otp, $user = null)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sandbox.co.in/kyc/aadhaar/okyc/otp/verify',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "@entity" => "in.co.sandbox.kyc.aadhaar.okyc.request",
                "reference_id" => $referenceId,
                "otp" => $otp
            )),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $this->SANDBOX_ACCESS_TOKEN,
                'x-api-key: ' . $this->SANDBOX_API_KEY,
                'x-api-version: ' . $this->SANDBOX_API_VERSION,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

          $responseData = json_decode($response, true);

        if (isset($responseData['data']['message']) == "Aadhaar Card Exists") {

            \Log::info("Message: " . $responseData['data']['message']);

            $user = User::where("id", $user)->first();
            $user->aadhaar_data = $responseData;
            $user->aadhaar_verified = 1;
            $user->save();
        }


        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return json_encode(['error' => $err]);
        }

      
        return json_decode($response, true);
    }
}
