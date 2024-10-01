<?php

namespace Modules\Sale\Listeners;

use Modules\Sale\Events\SaleCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Sale\Traits\SaleSequenceManager;

class IncreaseNextSaleCode
{
    use SaleSequenceManager;

    /**
     * Handle the event.
     *
     * @param SaleCreated $event
     * @return void
     */
    public function handle(SaleCreated $event)
    {
        // Update next sale code
        $this->increaseNextSaleCode();
    }
}
