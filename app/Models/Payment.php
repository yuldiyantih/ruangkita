<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'project_id',
        'payment_stage_id',
        'amount',
        'payment_date',
        'reference_number',
        'proof_file',
        'payment_status',
        'note',
        'is_visible_to_client',
    ];

    protected function casts(): array
    {
        return [
            'payment_date' => 'date',
            'is_visible_to_client' => 'boolean',
        ];
    }


    public function project()
    {
        return $this->belongsTo(
            Project::class,
            'project_id',
            'project_id'
        );
    }


    public function paymentStage()
    {
        return $this->belongsTo(
            PaymentStage::class,
            'payment_stage_id',
            'payment_stage_id'
        );
    }
}
