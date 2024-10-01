<?php

namespace Modules\Product\Providers;

use Modules\Product\Events\ProductCreated;
use Modules\Product\Listeners\IncreaseNextProductCode;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ProductCreated::class => [
            IncreaseNextProductCode::class,
        ],
    ];
}
