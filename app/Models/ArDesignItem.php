<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArDesignItem extends Model
{
    protected $fillable = [
        'ar_design_id',
        'ar_asset_id',
        'position_x',
        'position_y',
        'position_z',
        'rotation_x',
        'rotation_y',
        'rotation_z',
        'scale_x',
        'scale_y',
        'scale_z',
    ];

    public function design()
    {
        return $this->belongsTo(ArDesign::class, 'ar_design_id');
    }

    public function asset()
    {
        return $this->belongsTo(ArAsset::class, 'ar_asset_id');
    }
}
