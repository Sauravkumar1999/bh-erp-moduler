<?php

namespace Modules\Product\Events;

use Illuminate\Queue\SerializesModels;

class ProductUpdated
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public $product)
    {
        //
    }

}
