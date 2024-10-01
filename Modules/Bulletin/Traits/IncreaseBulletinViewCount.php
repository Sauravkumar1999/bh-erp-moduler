<?php

namespace Modules\Bulletin\Traits;

trait IncreaseBulletinViewCount
{
    /**
     * Increase the view count for the bulletin.
     *
     * @param \Modules\Bulletin\Models\BulletinView $bulletinView
     * @return void
     */
    public function increaseViewCount($bulletinView)
    {
        $bulletinView->increment('view_count');
    }
}
