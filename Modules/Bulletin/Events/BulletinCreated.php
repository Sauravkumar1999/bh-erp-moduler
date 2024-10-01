<?php

namespace Modules\Bulletin\Events;

use Illuminate\Queue\SerializesModels;

class BulletinCreated
{
    use SerializesModels;
    public  $bulletin;

    /**
     * Create a new event instance.
     *
     * @param  $bulletin
     */
    public function __construct($bulletin)
    {
        $this->bulletin = $bulletin;
    }
}
