<?php


namespace Modules\PushNotification\Providers;

use Modules\PushNotification\Events\PushNotificationCreated;
use Modules\PushNotification\Listeners\SendNotifications;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        PushNotificationCreated::class => [
            SendNotifications::class,
        ]
    ];

}
