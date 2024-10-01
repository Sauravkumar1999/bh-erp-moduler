<?php

namespace Modules\PushNotification\Events;

use Illuminate\Queue\SerializesModels;

class PushNotificationCreated
{
    use SerializesModels;

    public $user;
    public $notification;

    /**
     * Create a new event instance.
     *
     * @param  $user
     * @param $notification
     */
    public function __construct($user, $notification)
    {
        $this->user = $user;
        $this->notification = $notification;
    }

}
