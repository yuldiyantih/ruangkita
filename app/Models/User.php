<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'profile_photo',
        'is_active',

        'notify_messages',
        'notify_progress',
        'notify_schedule',
        'notify_documentation',
        'notify_cost',

        'language',
        'timezone',
        'theme',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function administeredProjects()
    {
        return $this->hasMany(Project::class, 'admin_id');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',

            'notify_messages' => 'boolean',
            'notify_progress' => 'boolean',
            'notify_schedule' => 'boolean',
            'notify_documentation' => 'boolean',
            'notify_cost' => 'boolean',
        ];
    }
}
