<?php

namespace Modules\Company\Entities;

use Modules\User\Entities\User;
use Plank\Mediable\Mediable;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes, Mediable;

    protected $table = 'companies';

    protected $fillable = [
        'name', 'code', 'business_name', 'representative_name', 'registration_number', 'address',  'status'
    ];

    protected $casts = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }
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

    public function productRights()
    {
        return $this->morphToMany(Product::class, 'rightable')
            ->when(!is_admin_user(), function ($q) {
                return $q->where('sale_status', 'normal');
            })
            ->withPivot(['type', 'odr_app', 'product_expose']);
    }
}
