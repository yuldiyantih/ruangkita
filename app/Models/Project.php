<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $primaryKey = 'project_id';

    protected $fillable = [
        'client_id',
        'admin_id',
        'project_name',
        'description',
        'location',
        'start_date',
        'target_end_date',
        'project_status',
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
        return $this->belongsTo(
            Client::class,
            'client_id',
            'client_id'
        );
    }

    public function admin()
    {
        return $this->belongsTo(
            User::class,
            'admin_id',
            'user_id'
        );
    }

    public function areas()
    {
        return $this->hasMany(ProjectArea::class, 'project_id', 'project_id');
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'project_id', 'project_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'project_id', 'project_id');
    }

    public function materials()
    {
        return $this->hasMany(Material::class, 'project_id', 'project_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'project_id', 'project_id');
    }

    public function progressUpdates()
    {
        return $this->hasMany(ProgressUpdate::class, 'project_id', 'project_id');
    }

    public function documentations()
    {
        return $this->hasMany(Documentation::class, 'project_id', 'project_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'project_id', 'project_id');
    }

    public function arDesigns()
    {
        return $this->hasMany(ArDesign::class, 'project_id', 'project_id');
    }

    public function paymentStages()
    {
        return $this->hasMany(PaymentStage::class, 'project_id', 'project_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'project_id', 'project_id');
    }
}
