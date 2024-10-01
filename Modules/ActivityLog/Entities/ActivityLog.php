<?php

namespace Modules\ActivityLog\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_log';

    /**
     * Get the user associated with the subject_id.
     */
    public function subject()
    {
        return $this->belongsTo(User::class, 'subject_id');
    }

    /**
     * Get the user associated with the causer_id.
     */
    public function causer()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }

    /**
     * Get the formatted date.
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at ? $this->created_at->format('Y-m-d H:i:s') : 'N/A';
    }

    /**
     * Get the log details as an array.
     */
    public function getLogDetailsAttribute()
    {
        return json_decode($this->properties, true);
    }
}