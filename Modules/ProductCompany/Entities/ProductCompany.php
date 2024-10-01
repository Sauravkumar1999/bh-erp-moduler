<?php

namespace Modules\ProductCompany\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\Product;
use Modules\User\Entities\User;
use Plank\Mediable\Mediable;

class ProductCompany extends Model
{
    use HasFactory, SoftDeletes, Mediable;

    protected $table = 'product_companies';
    protected $fillable = [
        'name',
        'status',
        'url',
        'business_name',
        'representative_name',
        'registration_number',
        'address',
        'registration_date',
    ];
    protected $casts = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function logo()
    {
        return $this->hasMedia('logo') ? route('media.image.display', $this->firstMedia('logo')) : null;
    }

    public function contract()
    {
        return $this->hasMedia('contract') ? route('media.image.display', $this->firstMedia('contract')) :
            asset('images/no-image.png');
    }
}
