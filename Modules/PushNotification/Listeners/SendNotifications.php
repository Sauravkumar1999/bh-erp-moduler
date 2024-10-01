<?php

namespace Modules\PushNotification\Listeners;

use Modules\PushNotification\Events\PushNotificationCreated;
use Modules\PushNotification\Services\FirebaseNotificationService;

class SendNotifications
{

    /**
     * Handle the event.
     *
     * @param PushNotificationCreated $event
     * @return void
     */
    public function handle(PushNotificationCreated $event)
    {
        // push notifications send code goes here ....

        //$event->notification
        //$event->user
        $firebaseNotificationService = new FirebaseNotificationService();
        $firebaseNotificationService->notificationTrigger($event->user->id);
    }
}
