<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArAsset extends Model
{
    protected $fillable = [
        'name',
        'asset_type',
        'category',
        'color_code',
        'texture_path',
        'model_3d_path',
        'thumbnail_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function designItems()
    {
        return $this->hasMany(ArDesignItem::class);
    }
}
