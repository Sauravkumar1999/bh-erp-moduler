<?php

namespace Modules\Sale\Services;

use Modules\Product\Entities\Product;
use Modules\Sale\Entities\Sale;
use Modules\Sale\Events\SaleCreated;
use Modules\Sale\Events\SaleUpdated;
use Modules\Sale\Traits\SaleSequenceManager;
use Modules\User\Entities\User;
use Modules\Company\Entities\Company;

class SaleService
{
    use SaleSequenceManager;

    public function create(array $saleData): Sale
    {
        $sale = new Sale();
        $sale->code = $this->getNextSaleCode();
        $sale->product_sale_day = $saleData['product_sale_day'];
        $sale->product_id = $saleData['product_id'];
        $sale->remark = $saleData['remark'];
        $sale->user_id = $saleData['user_id'];
        $sale->seller_id = $saleData['seller_id'];
        $sale->sales_price = str_replace(',', '', $saleData['sales_price']);
        // $sale->sales_type = $saleData['sales_type']; // since we remove the radio buttons
        $sale->product_price = $saleData['product_price'];
        $sale->fee_type = $saleData['fee_type'];
        $sale->take = str_replace(',', '', $saleData['take']);
        $sale->number_of_sales = str_replace(',', '', $saleData['number_of_sales']);
        $sale->sales_information = $saleData['sales_information'];
        // $sale->operating_income = str_replace(',', '', $saleData['operating_income']);
        $sale->sales_status = config('sale.default-sales-status');
        $res = $sale->save();
        event(new SaleCreated($sale));
        return $sale;
    }


    public function update(Sale $sale, array $saleData): Sale
    {
        $sale->product_sale_day = $saleData['product_sale_day'];
        $sale->product_id = $saleData['product_id'];
        $sale->remark = $saleData['remark'];
        $sale->seller_id = $saleData['seller_id'];
        if (!empty($saleData['sales_price']))
            $sale->sales_price = str_replace(',', '', $saleData['sales_price']);
        else
            $sale->sales_price = 0;

        // $sale->sales_type = $saleData['sales_type']; //since we remove the radio buttons
        $sale->product_price = $saleData['product_price'];
        $sale->fee_type = $saleData['fee_type'];
        $sale->take = str_replace(',', '', $saleData['take']);
        $sale->number_of_sales = str_replace(',', '', $saleData['number_of_sales']);
        $sale->sales_information = $saleData['sales_information'];
        //$sale->operating_income = str_replace(',', '', $saleData['operating_income']);

        if ($this->hasApprovalRights($saleData['product_id'])) {
            if ($saleData['sales_status']) {
                $sale->sales_status = $saleData['sales_status'];
            }
        }
        $res = $sale->save();
        event(new SaleUpdated($sale));
        return $sale;
    }


    /****************dropdown data*****************/
    public function getDropdownDataQuery()
    {
        $products = get_auth_products();
        $companies = Company::query()->get();
        //$users = User::select(['id', 'code', 'first_name', 'last_name'])->get();
        $users = get_auth_users();
        return [
            'products'  => $products,
            'companies' => $companies,
            'users'     => $users,
        ];
    }

    public function hasApprovalRights($product_id)
    {
        if (isset($product_id)) {
            $product = Product::find($product_id);
            return $product->approvalRights()->where('id', auth()->id())->exists();
        }

        return false;
    }
    /****************dropdown data*****************/
}
