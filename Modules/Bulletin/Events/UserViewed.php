<?php

namespace Modules\Bulletin\Events;

use Illuminate\Queue\SerializesModels;

class UserViewed
{
    use SerializesModels;

    public $bulletinView;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($bulletinView)
    {
        $this->bulletinView = $bulletinView;
    }
}
