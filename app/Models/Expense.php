<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
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
        return $this->belongsTo(Project::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function personalFund()
    {
        return $this->hasOne(PersonalFund::class);
    }
}
