<?php

namespace Modules\Company\Providers;

use Modules\Company\Events\CompanyCreated;
use Modules\Company\Listeners\AssignToSalesFullDisclosureProduct;
use Modules\Company\Listeners\IncreaseNextCompanyCode;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        CompanyCreated::class => [
            IncreaseNextCompanyCode::class,
            AssignToSalesFullDisclosureProduct::class
        ]
    ];
}
