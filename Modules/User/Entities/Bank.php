<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{

    protected $fillable = [
        'bank_name', 'display_name', 'status'
    ];

    public function scopeWhereStatus($query, $status)
    {
        return $query->where('status', $status);
    }

}
