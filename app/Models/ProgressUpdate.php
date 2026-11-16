<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgressUpdate extends Model
{
    protected $primaryKey = 'progress_update_id';

    protected $fillable = [
        'project_id',
        'created_by',
        'percentage',
        'description',
        'update_date',
        'photo_path',
    ];

    protected $casts = [
        'update_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(
            Project::class,
            'project_id',
            'project_id'
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
}
