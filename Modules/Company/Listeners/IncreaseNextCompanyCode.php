<?php

namespace Modules\Company\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Company\Events\CompanyCreated;
use Modules\Company\Traits\ManageCompanySquence;

class IncreaseNextCompanyCode
{
    use ManageCompanySquence;

    /**
     * Handle the event.
     *
     * @param CompanyCreated $event
     * @return void
     */
    public function handle(CompanyCreated $event)
    {
        // Update next company code
        $this->increaseNextCompanyCode();
    }
}
