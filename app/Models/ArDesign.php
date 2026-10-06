<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArDesign extends Model
{
    protected $fillable = [
        'project_id',
        'project_area_id',
        'client_id',
        'design_name',
        'preview_image',
        'notes',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function area()
    {
        return $this->belongsTo(ProjectArea::class, 'project_area_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(ArDesignItem::class);
    }
}
