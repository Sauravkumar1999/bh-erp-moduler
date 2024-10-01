<?php

namespace Modules\Slider\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\View;
use Modules\Slider\Entities\Slider;

class SliderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'slider';
    }
    public static function render($sliderSystemName, $template = null)
    {
        $slider = Slider::where('slug', $sliderSystemName)->first();
        if ($template === null) {
            $template = 'slider::templates.default-slider';
        }

        if (!$slider || !$slider->status) {
            return '';
        }

        $view = View::make($template)
            ->with([
                'slider' => $slider,
            ]);

        return $view->render();
    }
}
