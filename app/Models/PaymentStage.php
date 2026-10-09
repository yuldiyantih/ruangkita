<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentStage extends Model
{
    protected $fillable = [
        'project_id',
        'title',
        'percentage',
        'amount',
        'due_date',
        'status',
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
        return $this->belongsTo(Project::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
