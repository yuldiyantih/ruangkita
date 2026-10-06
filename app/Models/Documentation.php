<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $fillable = [
        'project_id',
        'project_area_id',
        'uploaded_by',
        'category',
        'media_type',
        'title',
        'description',
        'file_path',
        'photo_date',
        'is_visible_to_client',
    ];

    protected $casts = [
        'photo_date' => 'date',
        'is_visible_to_client' => 'boolean',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function projectArea()
    {
        return $this->belongsTo(ProjectArea::class, 'project_area_id');
    }
}
