<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'client_id',
        'admin_id',
        'project_name',
        'description',
        'location',
        'start_date',
        'target_end_date',
        'status',
        'progress_percentage',
        'budget_total',
        'cover_image',
    ];

    protected $casts = [
        'start_date' => 'date',
        'target_end_date' => 'date',
        'budget_total' => 'decimal:2',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function areas()
    {
        return $this->hasMany(ProjectArea::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function progressUpdates()
    {
        return $this->hasMany(ProgressUpdate::class);
    }

    public function documentations()
    {
        return $this->hasMany(
            Documentation::class,
            'project_area_id'
        );
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function arDesigns()
    {
        return $this->hasMany(ArDesign::class);
    }
}
