<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $primaryKey = 'work_id';

    protected $fillable = [
        'project_id',
        'work_name',
        'method_type',
        'volume',
        'unit',
        'unit_price',
        'duration_days',
        'total_cost',
        'work_status',
        'is_visible_to_client',
    ];

    protected $casts = [
        'is_visible_to_client' => 'boolean',
        'volume' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_cost' => 'decimal:2',
    ];

    public function project()
    {
        return $this->belongsTo(
            Project::class,
            'project_id',
            'project_id'
        );
    }

    public function schedules()
    {
        return $this->hasMany(
            Schedule::class,
            'work_id',
            'work_id'
        );
    }
}
