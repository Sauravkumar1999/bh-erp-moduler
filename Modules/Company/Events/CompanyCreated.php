<?php

namespace Modules\Company\Events;

use Illuminate\Queue\SerializesModels;

class CompanyCreated
{
    use SerializesModels;

    public $company;

    /**
     * Create a new event instance.
     *
     * @param  $company
     */
    public function __construct($company)
    {
        $this->company = $company;
    }
}
