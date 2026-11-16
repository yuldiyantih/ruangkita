<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectArea extends Model
{
    protected $primaryKey = 'project_area_id';

    protected $fillable = [
        'project_id',
        'area_name',
        'description',
        'photo',
        'progress_percentage',
    ];

    public function project()
    {
        return $this->belongsTo(
            Project::class,
            'project_id',
            'project_id'
        );
    }

    public function arDesigns()
    {
        return $this->hasMany(
            ArDesign::class,
            'project_area_id',
            'project_area_id'
        );
    }
}
