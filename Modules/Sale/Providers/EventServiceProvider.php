<?php

namespace Modules\Sale\Providers;

use Modules\Sale\Events\SaleCreated;
use Modules\Sale\Events\SaleUpdated;
use Modules\Sale\Listeners\IncreaseNextSaleCode;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SaleCreated::class => [
            IncreaseNextSaleCode::class,
        ],
        SaleUpdated::class => [

        ]
    ];
}
