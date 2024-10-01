<?php


namespace Modules\User\Widgets;

use Arrilot\Widgets\AbstractWidget;

class TestWidget extends AbstractWidget
{
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //if (user()->isAbleTo('view-test-widget')) {

            return view('user::users.widgets.test', [
                'title' => 'Test Widget',
                'text'  => 20
            ]);

       // } else {

         //   return '';
        //}
    }
}
