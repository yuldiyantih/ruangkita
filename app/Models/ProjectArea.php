<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectArea extends Model
{
    protected $fillable = [
        'project_id',
        'area_name',
        'description',
        'photo',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function arDesigns()
    {
        return $this->hasMany(ArDesign::class);
    }
}
