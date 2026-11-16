<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArDesign extends Model
{
    protected $primaryKey = 'ar_design_id';

    protected $fillable = [
        'project_id',
        'project_area_id',
        'client_id',
        'design_name',
        'preview_image',
        'notes',
        'ar_design_status',
    ];

    public function project()
    {
        return $this->belongsTo(
            Project::class,
            'project_id',
            'project_id'
        );
    }

    public function area()
    {
        return $this->belongsTo(
            ProjectArea::class,
            'project_area_id',
            'project_area_id'
        );
    }

    public function client()
    {
        return $this->belongsTo(
            Client::class,
            'client_id',
            'client_id'
        );
    }

    public function items()
    {
        return $this->hasMany(
            ArDesignItem::class,
            'ar_design_id',
            'ar_design_id'
        );
    }
}
