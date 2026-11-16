<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $primaryKey = 'expense_id';

    protected $fillable = [
        'project_id',
        'material_id',
        'created_by',
        'expense_date',
        'store_name',
        'category',
        'description',
        'amount',
        'funding_source',
        'receipt_path',
        'is_visible_to_client',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
        'is_visible_to_client' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(
            Project::class,
            'project_id',
            'project_id'
        );
    }

    public function material()
    {
        return $this->belongsTo(
            Material::class,
            'material_id',
            'material_id'
        );
    }

    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by',
            'user_id'
        );
    }

    public function personalFund()
    {
        return $this->hasOne(
            PersonalFund::class,
            'expense_id',
            'expense_id'
        );
    }
}
