<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalFund extends Model
{
    protected $primaryKey = 'personal_fund_id';

    protected $fillable = [
        'expense_id',
        'user_id',
        'amount',
        'reimbursement_status',
        'reimbursement_date',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'reimbursement_date' => 'date',
    ];

    public function expense()
    {
        return $this->belongsTo(
            Expense::class,
            'expense_id',
            'expense_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }
}
