<?php

namespace Modules\Product\Entities;

use Plank\Mediable\Mediable;
use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Company\Entities\Company;
use Modules\ProductCompany\Entities\ProductCompany;

class Product extends Model
{
    use SoftDeletes, Mediable;

    protected $table = 'products';

    protected $fillable = [
        'code',
        'product_name',
        'product_description',
        'product_price',
        'commission_type',
        'main_url',
        'url_params',
        'url_1',
        'url_2',
        'urls_open_mode',
        'sale_rights_disclosure',
        'approval_rights_disclosure',
        'group',
        'branch_representative',
        'referral_bonus',
        'other_fees',
        'bh_operating_profit',
        'user_id',
        'exposer_order',
        'product_commissions',
        'bh_sale_commissions',
        'sale_status',
        'contact_notifications',
    ];

    protected $casts = [
        'sale_rights'         => 'array',
        'approval_rights'     => 'array',
        'product_commissions' => 'array',
        'url_params'          => 'array',
    ];

    public function getProductPriceAttribute($price)
    {
        return price_formatter($price);
    }
    public function getReferralBonusAttribute($bonus)
    {
        return price_formatter($bonus);
    }
    public function getOtherFeesAttribute($fee)
    {
        return price_formatter($fee);
    }
    public function getBhOperatingProfitAttribute($profit)
    {
        return price_formatter($profit);
    }
    public function getBhSaleCommissionsAttribute($profit)
    {
        return price_formatter($profit);
    }

    // get the banner image
    public function banner()
    {
        return $this->hasMedia('banner') ? route('media.image.display', $this->firstMedia('banner')) :
            '';
      //  https: //www.gravatar.com/avatar/' . md5(strtolower(trim($this->email)))
    }


    // ===== Relations section ======

    //product created user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(ProductCompany::class,'company_id');
    }
    public function saleRights()
    {
        return $this->morphedByMany(Company::class, 'rightable')
            ->withPivot(['type', 'odr_app', 'product_expose']);
    }

    public function approvalRights()
    {
        return $this->morphedByMany(User::class, 'rightable')
            ->withPivot(['type', 'odr_app', 'product_expose']);
    }

    public function adminUserSettings()
    {
        return $this->belongsToMany(User::class, 'prod_user_settings', 'product_id', 'user_id')
            ->withPivot('url', 'status');
    }
}
