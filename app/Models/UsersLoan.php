<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan_id',
        'agreed',
        'agreed_date',
        'payment_transaction',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
      public function UserKyc()
    {
        return $this->hasOne(UserKyc::class, 'user_id', 'user_id');
    }
    public function loan()
    {
        return $this->belongsTo(Loan::class, 'id', 'loan_id');
    }
  
}
