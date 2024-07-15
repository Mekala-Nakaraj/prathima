<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

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

        // Update or create settings based on form data
        foreach ($request->except('_token') as $key => $value) {
            Settings::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Payment configuration updated successfully.');
    }
}
