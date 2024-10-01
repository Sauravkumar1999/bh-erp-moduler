<?php

namespace Modules\Bulletin\Listeners;

use Modules\Bulletin\Events\UserViewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Bulletin\Traits\IncreaseBulletinViewCount;

class IncreaseViewCount
{
    use IncreaseBulletinViewCount;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserViewed $event
     * @return void
     */
    public function handle(UserViewed $event)
    {
        $this->increaseViewCount($event->bulletinView);
    }
}
