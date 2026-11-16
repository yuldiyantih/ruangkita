<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $primaryKey = 'schedule_id';

    protected $fillable = [
        'project_id',
        'work_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'schedule_status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(
            Project::class,
            'project_id',
            'project_id'
        );
    }

    public function work()
    {
        return $this->belongsTo(
            Work::class,
            'work_id',
            'work_id'
        );
    }
}
