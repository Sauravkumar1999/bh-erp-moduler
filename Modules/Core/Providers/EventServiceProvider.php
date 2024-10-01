<?php

namespace Modules\Core\Providers;

use Modules\Core\Events\DocCodeUpdated;
use Modules\Core\Listeners\UpdateDocumentCode;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        DocCodeUpdated::class => [
            UpdateDocumentCode::class,
        ],
    ];
}
