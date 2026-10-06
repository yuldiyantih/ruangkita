<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'project_id',
        'material_name',
        'quantity',
        'unit',
        'unit_price',
        'total_price',
        'supplier',
        'purchase_date',
        'is_visible_to_client',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'is_visible_to_client' => 'boolean',
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
