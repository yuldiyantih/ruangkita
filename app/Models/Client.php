<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $primaryKey = 'client_id';

    protected $fillable = [
        'user_id',
        'address',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
            'user_id'
        );
    }

    public function projects()
    {
        return $this->hasMany(
            Project::class,
            'client_id',
            'client_id'
        );
    }

    public function arDesigns()
    {
        return $this->hasMany(
            ArDesign::class,
            'client_id',
            'client_id'
        );
    }
}
