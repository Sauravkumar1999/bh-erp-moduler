<?php

namespace Modules\Core\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Plank\Mediable\Mediable;

class PageMeta extends Model
{
    use HasFactory, Mediable;

    protected $fillable = [
        'page_url',
        'meta_information',
        'status',
    ];
    protected $casts = [
        'meta_information' => 'array'
    ];
    public function og_image()
    {
        return $this->hasMedia('og_image') ? route('media.image.display', $this->firstMedia('og_image')) :
            '';
    }
}
