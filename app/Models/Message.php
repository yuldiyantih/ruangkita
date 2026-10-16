<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'project_id',
        'sender_id',
        'receiver_id',
        'message_text',

        'attachment_path',
        'attachment_name',
        'attachment_type',
        'attachment_size',

        'is_read',
        'sent_at',
    ];


    protected $casts = [
        'is_read' => 'boolean',
        'sent_at' => 'datetime',
        'attachment_size' => 'integer',
    ];


    /*
    |--------------------------------------------------------------------------
    | PROJECT
    |--------------------------------------------------------------------------
    */

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    /*
    |--------------------------------------------------------------------------
    | PENGIRIM
    |--------------------------------------------------------------------------
    */

    public function sender()
    {
        return $this->belongsTo(
            User::class,
            'sender_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PENERIMA
    |--------------------------------------------------------------------------
    */

    public function receiver()
    {
        return $this->belongsTo(
            User::class,
            'receiver_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HELPER - APAKAH PUNYA LAMPIRAN
    |--------------------------------------------------------------------------
    */

    public function hasAttachment(): bool
    {
        return !empty($this->attachment_path);
    }


    /*
    |--------------------------------------------------------------------------
    | HELPER - FOTO
    |--------------------------------------------------------------------------
    */

    public function isImage(): bool
    {
        return $this->attachment_type
            && str_starts_with(
                $this->attachment_type,
                'image/'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HELPER - VIDEO
    |--------------------------------------------------------------------------
    */

    public function isVideo(): bool
    {
        return $this->attachment_type
            && str_starts_with(
                $this->attachment_type,
                'video/'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | HELPER - DOKUMEN
    |--------------------------------------------------------------------------
    */

    public function isDocument(): bool
    {
        return $this->hasAttachment()
            && !$this->isImage()
            && !$this->isVideo();
    }
}
