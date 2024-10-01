<?php

namespace Modules\Core\Events;

use Illuminate\Queue\SerializesModels;

class DocCodeUpdated
{
    use SerializesModels;

    public $setting;

    /**
     * Create a new event instance.
     *
     * @param  $setting
     */
    public function __construct($setting)
    {
        $this->setting = $setting;
    }
}
