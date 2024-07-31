<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Validator;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class SettingsController extends Controller
{
    public function PaymentConf()
    {
        $settings = Settings::all(); 
        return view('backend.settings.paymentconf', compact('settings'));
    }
  
    public function PaymentConfStore(Request $request)
    {
        $request->validate([
            'live_payment_gateway_title' => 'required',
            'razerpay_live_api_key' => 'required',
            'razerpay_live_api_secret_key' => 'required',
            'live_mode' => 'required|in:live,test', 
        ]);

        foreach ($request->except('_token') as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Payment configuration successfully.');
    }

    public function InitialLoanConfShow()
    {
        $settings = Settings::all(); 
        return view('backend.settings.initialloan', compact('settings'));
    }
  
    public function InitialLoanConf(Request $request)
    {
        $request->validate([
            'initial_loan_amount' => 'required',
            'initial_interest_rate' => 'required', 
            'loan_paid_date' => 'required', 
        ]);

      
        foreach ($request->except('_token') as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'initial configuration  successfully.');
    }

    public function EmailConfShow()
    {
        $settings = Settings::all(); 
        return view('backend.settings.MailConf', compact('settings'));
    }

    // public function EmailConfStore(Request $request)
    // {
    
    //     $validator = Validator::make($request->all(), [
    //         'MAIL_MAILER' => 'required|string',
    //         'MAIL_HOST' => 'required|string',
    //         'MAIL_PORT' => 'required|integer',
    //         'MAIL_USERNAME' => 'required|string',
    //         'MAIL_PASSWORD' => 'required|string',
    //         'MAIL_ENCRYPTION' => 'required|string',
    //         'MAIL_FROM_ADDRESS' => 'required|email',
    //         'MAIL_FROM_NAME' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $this->updateEnv([
    //         'MAIL_MAILER' => $request->MAIL_MAILER,
    //         'MAIL_HOST' => $request->MAIL_HOST,
    //         'MAIL_PORT' => $request->MAIL_PORT,
    //         'MAIL_USERNAME' => $request->MAIL_USERNAME,
    //         'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
    //         'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION,
    //         'MAIL_FROM_ADDRESS' => $request->MAIL_FROM_ADDRESS,
    //         'MAIL_FROM_NAME' => $request->MAIL_FROM_NAME,
    //     ]);
      
    //     foreach ($request->except('_token') as $key => $value) {
    //         Settings::updateOrCreate(['key' => $key], ['value' => $value]);
    //     }

    //     return redirect()->back()->with('success', 'initial configuration  successfully.');
    // }

    // protected function updateEnv(array $data)
    // {
    //     $envPath = base_path('.env');
    //     $env = file_get_contents($envPath);

    //     foreach ($data as $key => $value) {
    //         // Replace existing key
    //         if (strpos($env, $key) !== false) {
    //             $env = preg_replace('/^' . $key . '=.*/m', $key . '=' . $value, $env);
    //         } else {
    //             // Append new key if it does not exist
    //             $env .= "\n" . $key . '=' . $value;
    //         }
    //     }

    //     file_put_contents($envPath, $env);
    // }

    public function EmailConfStore(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'MAIL_MAILER' => 'required|string',
            'MAIL_HOST' => 'required|string',
            'MAIL_PORT' => 'required|integer',
            'MAIL_USERNAME' => 'required|string',
            'MAIL_PASSWORD' => 'required|string',
            'MAIL_ENCRYPTION' => 'required|string',
            'MAIL_FROM_ADDRESS' => 'required|email',
            'MAIL_FROM_NAME' => 'required|string',
            // 'TEST_EMAIL' => 'required|email',
        ]);

        // Send a test email
        $testEmail = $request->input('TEST_EMAIL');
        $messageContent = 'This is a test email from your mail configuration.';
        Mail::to($testEmail)->send(new TestMail($messageContent));
        return redirect()->back()->with('success', 'Settings saved and test email sent.');
    }

    public function SMSConfShow()
    {
        $settings = Settings::all(); 
        return view('backend.settings.smsConf', compact('settings'));
    }
    public function SMSConfStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'SMS_GATEWAY_URL' => 'required|string',
            'SMS_API_KEY' => 'required|string',
            'SMS_SENDER_ID' => 'required|string',
            'TEST_PHONE_NUMBER' => 'required|string',
        ]);
   
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        foreach ($request->except('_token') as $key => $value) {
                Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        
            return redirect()->back()->with('success', 'initial configuration  successfully.');

        // Send a test SMS
        // $testPhoneNumber = $request->input('TEST_PHONE_NUMBER');
        // $gatewayUrl = $request->input('SMS_GATEWAY_URL');
        // $apiKey = $request->input('SMS_API_KEY');
        // $senderId = $request->input('SMS_SENDER_ID');
        // $message = 'This is a test SMS from your configuration.';

        // $response = Http::post($gatewayUrl, [
        //     'apiKey' => $apiKey,
        //     'sender' => $senderId,
        //     'to' => $testPhoneNumber,
        //     'message' => $message,
        // ]);

        // try {
        //     $response = Http::post($gatewayUrl, [
        //         'apiKey' => $apiKey,
        //         'sender' => $senderId,
        //         'to' => $testPhoneNumber,
        //         'message' => $message,
        //     ]);
    
        //     if ($response->successful()) {
        //         return redirect()->back()->with('success', 'Settings saved and test SMS sent.');
        //     } else {
        //         return redirect()->back()->with('error', 'Failed to send test SMS. Status: ' . $response->status());
        //     }
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Failed to send test SMS. Error: ' . $e->getMessage());
        // }
    }

    public function Sandbox(){
        $settings = Settings::all(); 
        return view('backend.settings.sandbox', compact('settings'));
    }

    public function SandboxUpdate(Request $request)
    {

        $request->validate([
            'sandbox_live_api_key' => 'required',
            'sandbox_secret_key' => 'required',
            'sandbox_version' => 'required',
        ]);

        foreach ($request->except('_token') as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Sandbox configuration successfully.');
    }
}
