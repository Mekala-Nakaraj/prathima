<?php

namespace App\Services;

class OTPService
{
    public function sendSMS($phoneNumber, $message)
    {
        // Implement your SMS service provider integration here
        // Example code (this is just a placeholder)
        // SMS::send($phoneNumber, $message);
        return true; // Return true for successful SMS send
    }
}
