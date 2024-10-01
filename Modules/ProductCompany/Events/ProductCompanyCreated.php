<?php

namespace Modules\ProductCompany\Events;

use Illuminate\Queue\SerializesModels;

class ProductCompanyCreated
{
    use SerializesModels;
    public $productcompany;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($productcompany)
    {
        $this->productcompany = $productcompany;
    }
}
