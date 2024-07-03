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
        'is_verified'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
