<?php

namespace Modules\Sale\Events;

use Illuminate\Queue\SerializesModels;

class SaleCreated
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
