<?php

namespace Modules\User\Providers;

use Modules\User\Events\UserCreated;
use Modules\User\Events\UserUpdated;
use Modules\User\Listeners\IncreaseNextUserCode;
use Modules\User\Listeners\SaveRecommender;
use Modules\User\Listeners\SetDefaultUserPermissions;
use Modules\User\Listeners\UserConfirmation;
use Modules\User\Events\UserLoggedOut;
use Modules\User\Listeners\LogoutMobileUser;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserCreated::class => [
           // IncreaseNextUserCode::class,
            UserConfirmation::class,
            SaveRecommender::class,
            SetDefaultUserPermissions::class,

        ],
        UserUpdated::class => [
            UserConfirmation::class,
            SaveRecommender::class
        ],
        UserLoggedOut::class => [
            LogoutMobileUser::class,
        ],
    ];
}
