<?php

namespace Modules\Slider\Services;

use Modules\Slider\Entities\Slider;
use Modules\Slider\Entities\SliderItem;

class SliderService
{
    public function save(array $data, Slider $slider = null): Slider
    {
        if (!$slider) {
            $is_new = true;
            $slider = new Slider();
        }
        $slider->name = $data['slider-name'];
        $slider->slug = $data['slider-slug'];
        $slider->description = $data['slider-description'];
        $slider->status = isset($data['slider-status']) ? 1 : 0;
        $slider->save();
        return $slider;
    }
    public function saveItem(array $data, SliderItem $item = null): SliderItem
    {
        if (!$item) {
            $is_new = true;
            $item = new SliderItem();
            $item->slider_id = $data['slider_id'];
        }
        $item->name = $data['name'];
        $item->title = $data['title'];
        $item->caption = $data['caption'];
        $item->url = $data['url'];
        $item->custom_html = $data['custom_html'];
        $item->status = $data['status'];
        $item->save();
        return $item;
    }
}
