<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Entities\Company;
use Modules\Product\Entities\Product;
use Modules\User\Entities\User;
use Plank\Mediable\Mediable;

class Sale extends Model
{
    use SoftDeletes, Mediable;

    protected $table = 'sales';

    protected $fillable = [
        'product_id',
        'product_sale_day',
        'remark',
        'user_id',
        'fee_type',
        'product_price',
        'sales_price',
        'sales_information',
        'seller_id',
        'number_of_sales',
        'take',
        'operating_income',
        'sales_status',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
    public function getProductPriceAttribute($price)
    {
        return price_formatter($price);
    }
    public function getSalesPriceAttribute($price)
    {
        return price_formatter($price);
    }
    public function getNumberOfSalesAttribute($price)
    {
        return price_formatter($price);
    }
    public function getFeeAttribute($price)
    {
        return price_formatter($price);
    }

    public function setFeeTypeAttribute($value)
    {
        $this->attributes['fee_type'] = ($value == trans('sale::sale.with-ratio') ? 'with-ratio' : 'fixed-price');
    }

    public function getOperatingIncomeAttribute($price)
    {
        return price_formatter($price);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
