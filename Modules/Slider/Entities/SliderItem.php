<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Plank\Mediable\Mediable;

class SliderItem extends Model
{
    use HasFactory, Mediable;

    protected $fillable = [
        'name',
        'title',
        'caption',
        'url',
        'custom_html',
        'status',
        'slider_id',
    ];
    public function slider()
    {
        return $this->belongsTo(Slider::class, 'slider_id');
    }
    public function image()
    {
        return $this->hasMedia('image') ? route('media.image.display', $this->firstMedia('image')) :
            '';
    }
}
