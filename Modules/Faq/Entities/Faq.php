<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory;

    const ENABLED = 1;
    const DISABLE = 0;

    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    public function scopeEnabled($query)
    {
        return $query->where('status', self::ENABLED);
    }


}
