<?php

namespace Modules\Allowance\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Allowance extends Model
{

    protected $guarded = ['id'];


    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
    public function getHeadquartersRepresentativeAllowanceAttribute($price)
    {
        return price_formatter($price);
    }
    public function getOrganizationDivisionAllowanceAttribute($price)
    {
        return price_formatter($price);
    }
    public function getPolicyAllowanceAttribute($price)
    {
        return price_formatter($price);
    }
    public function getOtherAllowancesAttribute($price)
    {
        return price_formatter($price);
    }
    public function getCommissionAttribute($price)
    {
        return price_formatter($price);
    }
    public function getTotalBeforeTaxAttribute($price)
    {
        return price_formatter($price);
    }
    public function getIncomeTaxAttribute($price)
    {
        return price_formatter($price);
    }
    public function getResidentTaxAttribute($price)
    {
        return price_formatter($price);
    }
    public function getYearEndSettlementAttribute($price)
    {
        return price_formatter($price);
    }
    public function getOtherDeductions1Attribute($price)
    {
        return price_formatter($price);
    }
    public function getOtherDeductions2Attribute($price)
    {
        return price_formatter($price);
    }
    public function getTotalDeductionAttribute($price)
    {
        return price_formatter($price);
    }
    public function getDeductedAmountReceivedAttribute($price)
    {
        return price_formatter($price);
    }
    public function getReferralBonusAttribute($price)
    {
        return price_formatter($price);
    }
}
