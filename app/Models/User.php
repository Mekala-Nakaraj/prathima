<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'alternative_email',
        'phone_number',
        'user_type',
        'otp_phone',
        'pincode',
        'city',
        'district',
        'state',
        'country',
        'gas_bill',
        'salary_slip',
        'gas_bill_path',
        'salary_slip_path',
        'gas_bill_number',
        'salary_slip_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    // public function findForPassport($username)
    // {
    //     return $this->orWhere('email', $username)->orWhere('phone_number', $username)->first();
    // }
    public function kyc()
    {
        return $this->hasOne(UserKyc::class);
    }
}
