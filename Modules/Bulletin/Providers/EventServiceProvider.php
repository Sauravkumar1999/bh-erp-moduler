<?php

namespace Modules\Bulletin\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Bulletin\Events\UserViewed;
use Modules\Bulletin\Listeners\IncreaseViewCount;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserViewed::class => [
            IncreaseViewCount::class,
        ],
    ];
}
