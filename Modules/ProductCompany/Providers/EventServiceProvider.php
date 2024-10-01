<?php

namespace Modules\ProductCompany\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\ProductCompany\Events\ProductCompanyCreated;
use Modules\ProductCompany\Listeners\NextProductCompanyCode;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ProductCompanyCreated::class => [NextProductCompanyCode::class]
    ];
}
