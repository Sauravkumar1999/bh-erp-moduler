<?php

namespace Modules\Product\Listeners;

use Modules\Product\Events\ProductCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Product\Traits\ProductSequenceManager;

class IncreaseNextProductCode
{
    Use ProductSequenceManager;
    /**
     * Handle the event.
     *
     * @param ProductCreated $event
     * @return void
     */
    public function handle(ProductCreated $event)
    {
        // Update next product code
        $this->increaseNextProductCode();
    }
}
