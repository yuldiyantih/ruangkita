<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $primaryKey = 'documentation_id';

    protected $fillable = [
        'project_id',
        'uploaded_by',
        'category',
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
        return $this->belongsTo(
            Project::class,
            'project_id',
            'project_id'
        );
    }

    public function uploader()
    {
        return $this->belongsTo(
            User::class,
            'uploaded_by',
            'user_id'
        );
    }
}
