<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKyc extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'aadhar_number',
        'pan_number',
        'account_number',
        'ifsc_code',
        'is_verified',
        'relationship_manager_verified',
        'field_manager_verified',
        'loan_amount',
        'reason',
        'pan_file',
        'aadhaar_file',
        'property_tax_recipt',
        'rental_agreement',
        'smart_card',
        'smart_card_file',
        'driving_license_file',
        'recent_gas_bill',
        'recent_broadband_bill',
        'pay_slip',
        'id_card',
        'pf_member_passbook',
        'account_holder_name',
        'house_type',
        'company_name',
        'company_email',
        'company_location',
        'address',
        'employment_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
