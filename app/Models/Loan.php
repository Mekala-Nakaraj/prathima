<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'loan_id',
        'interest_rate',
        'approved_loan_amount',
        'start_date',
        'due_date',
        'agreement',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
