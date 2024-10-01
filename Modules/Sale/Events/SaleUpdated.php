<?php

namespace Modules\Sale\Events;

use Illuminate\Queue\SerializesModels;

class SaleUpdated
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public $sale)
    {
        //
    }
}
