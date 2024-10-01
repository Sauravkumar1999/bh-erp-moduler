<?php

namespace Modules\PushNotification\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\PushNotification\Entities\PushNotification;

class Notifiable extends Model
{
    protected $table = 'notifiables';
    protected $fillable = ['push_notification_id', 'notifiable_type', 'notifiable_id'];

    public function pushNotification()
    {
        return $this->belongsTo(PushNotification::class, 'push_notification_id');
    }
}
