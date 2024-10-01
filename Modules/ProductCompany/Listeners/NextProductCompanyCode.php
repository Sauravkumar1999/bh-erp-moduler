<?php

namespace Modules\ProductCompany\Listeners;

use Modules\ProductCompany\Events\ProductCompanyCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\ProductCompany\Traits\ManageProductCompanySquence;

class NextProductCompanyCode
{
    use ManageProductCompanySquence;

    /**
     * Handle the event.
     *
     * @param ProductCompanyCreated $event
     * @return void
     */
    public function handle(ProductCompanyCreated $event)
    {
        $this->increaseNextProductCompanyCode();
    }
}
