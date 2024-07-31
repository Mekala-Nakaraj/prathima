<?php

namespace App\Services;

use App\Models\UserKyc;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class LoanService
{
    public function kyc(array $data)
    {
        $validator = Validator::make($data, [
            'aadhar_number' => 'required|string|max:255|unique:user_kycs',
            'loan_amount' => 'required|string|max:255',
            'pan_number' => 'required|string|max:255|unique:user_kycs',
            'pan_file' => 'required|file',
            'aadhar_file' => 'required|file',
            'account_number' => 'required|string|min:8',
            'ifsc_code' => 'required|string|min:8',
            'bank_name' => 'required|string',
            'property_tax_recipt' => 'nullable|file',
            'rental_agreement' => 'nullable|file',
            'smart_card_file' => 'required|file',
            'driving_license_file' => 'required|file',
            'recent_gas_bill' => 'required|file',
            'recent_broadband_bill' => 'required|file',
            'pay_slip' => 'required|file',
            'id_card' => 'required|file',
            'pf_member_passbook' => 'required|file',
            'account_holder_name' => 'required|string',

            'house_type' => 'required|string',
            'company_name' => 'required|string',
            'company_email' => 'required|string|unique:user_kycs',
            'company_location' => 'required|string',
            'address' => 'required|string',
            'employment_type' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validatedData = $validator->validated();

        $userKyc = new UserKyc();
        $userKyc->user_id = $data['user_id'];

        $this->handleFileUpload($validatedData, 'pan_file', $userKyc);
        $this->handleFileUpload($validatedData, 'aadhar_file', $userKyc);
        $this->handleFileUpload($validatedData, 'property_tax_recipt', $userKyc);
        $this->handleFileUpload($validatedData, 'rental_agreement', $userKyc);
        $this->handleFileUpload($validatedData, 'smart_card_file', $userKyc);
        $this->handleFileUpload($validatedData, 'driving_license_file', $userKyc);
        $this->handleFileUpload($validatedData, 'recent_gas_bill', $userKyc);
        $this->handleFileUpload($validatedData, 'recent_broadband_bill', $userKyc);
        $this->handleFileUpload($validatedData, 'pay_slip', $userKyc);
        $this->handleFileUpload($validatedData, 'id_card', $userKyc);
        $this->handleFileUpload($validatedData, 'pf_member_passbook', $userKyc);

        $userKyc->aadhar_number = $validatedData['aadhar_number'];
        $userKyc->loan_amount = $validatedData['loan_amount'];
        $userKyc->pan_number = $validatedData['pan_number'];
        $userKyc->account_number = $validatedData['account_number'];
        $userKyc->ifsc_code = $validatedData['ifsc_code'];
        $userKyc->bank_name = $validatedData['bank_name'];
        $userKyc->account_holder_name = $validatedData['account_holder_name'];

        $userKyc->house_type = $validatedData['house_type'];
        $userKyc->company_name = $validatedData['company_name'];
        $userKyc->company_location = $validatedData['company_location'];
        $userKyc->company_email = $validatedData['company_email'];
        $userKyc->address = $validatedData['address'];
        $userKyc->employment_type = $validatedData['employment_type'];
        $userKyc->save();

        return ['success' => "KYC Uploaded", 'result' => true];
    }

    private function handleFileUpload(array $validatedData, string $fieldName, UserKyc $userKyc)
    {
        if (isset($validatedData[$fieldName])) {
            $file = $validatedData[$fieldName];
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/user/kyc', $fileName, 'public');

            $userKyc->$fieldName = "/storage/" . $filePath;
        }
    }
    


    public function updateKyc(array $data, UserKyc $userKyc)
    {
        $validator = Validator::make($data, $this->getValidationRules($userKyc));
    
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    
        $validatedData = $validator->validated();
        $this->populateUserKyc($validatedData, $userKyc);
        $userKyc->save();
    
        return ['success' => "KYC Updated"];
    }
    
    
    public function getValidationRules(UserKyc $userKyc)
    {
        return [
            'aadhar_number' => 'required|string|max:255|unique:user_kycs,aadhar_number,' . $userKyc->id,
            'loan_amount' => 'required|string|max:255',
            'pan_number' => 'required|string|max:255|unique:user_kycs,pan_number,' . $userKyc->id,
            'pan_file' => 'sometimes|file',
            'aadhar_file' => 'sometimes|file',
            'account_number' => 'required|string|min:8',
            'ifsc_code' => 'required|string|min:8',
            'bank_name' => 'required|string',
            'property_tax_recipt' => 'sometimes|file',
            'rental_agreement' => 'sometimes|file',
            'smart_card_file' => 'sometimes|file',
            'driving_license_file' => 'sometimes|file',
            'recent_gas_bill' => 'sometimes|file',
            'recent_broadband_bill' => 'sometimes|file',
            'pay_slip' => 'sometimes|file',
            'id_card' => 'sometimes|file',
            'pf_member_passbook' => 'sometimes|file',
            'account_holder_name' => 'required|string',
            'house_type' => 'required|string',
            'company_name' => 'required|string',
            'company_email' => 'required|string',
            'company_location' => 'required|string',
            'address' => 'required|string',
            'employment_type' => 'required|string',

        ];
    }
    
    
    
    private function populateUserKyc(array $data, UserKyc $userKyc)
    {
        foreach ($data as $key => $value) {
            if ($key === 'pan_file' || 
                $key === 'aadhar_file' || 
                $key === 'property_tax_recipt' || 
                $key === 'rental_agreement' || 
                $key === 'smart_card_file' || 
                $key === 'driving_license_file' || 
                $key === 'recent_gas_bill' || 
                $key === 'recent_broadband_bill' || 
                $key === 'pay_slip' || 
                $key === 'id_card' || 
                $key === 'pf_member_passbook'
            ) {
                $this->handleFileUploadupdate($value, $key, $userKyc);
            } else {
                if ($key !== 'user_id') {
                    $userKyc->$key = $value;
                }
            }
        }
    }
    
    
    private function handleFileUploadupdate($file, string $fieldName, UserKyc $userKyc)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/user/kyc', $fileName, 'public');
    
        $userKyc->$fieldName = "/storage/" . $filePath;
    }
    
    public function updateuser(array $data,User $user)
{
    $validator = Validator::make($data, [
        'name' => 'required|string|max:255',
        'pincode' => 'required|numeric',
        'city' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'country' => 'required|string',
        'gender' => 'required|string',
        'dob' => 'required|string',
        'address' =>'required|string|max:255',
        'house_type' => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
        'company_email' =>'required|email',
        'company_location' => 'required|string|max:255',           
    ]);

    if ($validator->fails()) {
        throw new ValidationException($validator);
    }

    $validatedData = $validator->validated();

    $user->name = $validatedData['name'];
    $user->pincode = $validatedData['pincode'];
    $user->city = $validatedData['city'];
    $user->district = $validatedData['district'];
    $user->state = $validatedData['state'];
    $user->country = $validatedData['country'];
    $user->gender = $validatedData['gender'];
    $user->dob = $validatedData['dob'];
    $user->address = $validatedData['address'];
    $user->house_type = $validatedData['house_type'];
    $user->company_name = $validatedData['company_name'];
    $user->company_email = $validatedData['company_email'];
    $user->company_location = $validatedData['company_location'];

    $user->save();

    return ['success' => "KYC Updated", 'result' => true];
}

}
