<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentStage extends Model
{
    protected $primaryKey = 'payment_stage_id';

    protected $fillable = [
        'project_id',
        'title',
        'percentage',
        'amount',
        'due_date',
        'payment_stage_status',
        'sort_order',
        'is_visible_to_client',
    ];


    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'percentage' => 'decimal:2',
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

    public function payments()
    {
        return $this->hasMany(
            Payment::class,
            'payment_stage_id',
            'payment_stage_id'
        );
    }
}
