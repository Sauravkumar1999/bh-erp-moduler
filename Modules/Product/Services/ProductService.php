<?php

namespace Modules\Product\Services;

use Modules\Product\Events\ProductCreated;
use Modules\Product\Events\ProductUpdated;
use Modules\User\Entities\User;
use Modules\Product\Entities\Product;
use Modules\Company\Entities\Company;
use Modules\Media\Traits\MediaHandler;
use Modules\Product\Traits\ProductSequenceManager;

class ProductService
{
    use MediaHandler, ProductSequenceManager;

    public function save(array $data, Product $product = null): Product
    {
        $is_new = false;

        $commissiondata = [
            "normal"      => [
                'commission_bp'  => str_replace(',', '', $data['bp']),
                'commission_ba'  => str_replace(',', '', $data['ba']),
                'commission_md'  => str_replace(',', '', $data['md']),
                'commission_pmd' => str_replace(',', '', $data['pmd']),
            ],
            "headquarter" => [
                'md'  => str_replace(',', '', isset($data['h_md']) ? $data['h_md'] : 0),
                'pmd' => str_replace(',', '', isset($data['h_pmd']) ? $data['h_pmd'] : 0),
            ]
        ];

        if (!$product) {
            $is_new = true;
            $product = new Product();
            $product->code = $this->getNextProductCode();
        }

        $product->product_name = $data['product_name'];
        $product->company_id = $data['productcompany_id'];
        $product->commission_type = $data['commission_type'];
        $product->product_description = $data['product_description'];
        $product->referral_bonus = (isset($data['referral_bonus']) ? str_replace(',', '', $data['referral_bonus']) : 0);
        $product->other_fees = str_replace(',', '', $data['other_fees']);
        // $product->bh_operating_profit = str_replace(',', '', $data['bh_operating_profit']);
        $product->bh_sale_commissions = str_replace(',', '', $data['bh_sale_commissions']);
        $product->main_url = $data['main_url'];
        $product->url_1 = $data['url_1'];
        $product->user_id = $data['user_id'] ?? auth()->id();
        $product->exposer_order = $data['exposer_order'];
        $product->sale_status = $data['sale_status'];
        $product->url_params = $data['url_params'];
        $product->contact_notifications = $data['contact_notifications'];
        //        $approvalRight = ($data['approval_rights'] === 'all_user') ? 'all_user' : $data['approval_rights'];
        //        $saleRight = ($data['sale_rights'] === 'full_disclosure') ? 'full_disclosure' : $data['company_id'];
        //        $product->sale_rights = $saleRight;
        //        $product->approval_rights = $approvalRight;
        $product->product_price = ($data['product_price'] == '') ? 0.00 : str_replace(',', '', $data['product_price']);
        $product->product_commissions = $commissiondata;
        $product->save();

        $this->saveApprovalRights($product, $data['approval_rights']);
        $this->saveSaleRights($product, $data['sale_rights'], isset($data['company_id']) ? $data['company_id'] : []);

        if ($is_new) {
            event(new ProductCreated($product));
        } else {
            event(new ProductUpdated($product));
        }

        return $product;
    }

    private function saveApprovalRights(?Product $product, mixed $approval_rights)
    {
        if (!empty($approval_rights)) {

            $product->approvalRights()->detach();

            if ($approval_rights[0] === 'all_user') {
                $product->update(['approval_rights_disclosure' => 'full']);
                $approval_rights = User::all()->pluck('id')->toArray();
            } else {
                $product->update(['approval_rights_disclosure' => 'partial']);
            }

            foreach ($approval_rights as $right_id) {
                $user = User::find($right_id);
                if ($user && $user->productRights()->exists()) {
                    $product->approvalRights()->attach($right_id, [
                        'type'    => 'approval_rights',
                        'odr_app' => $user->productRights()->max('odr_app') + 1
                    ]);
                } else {
                    $product->approvalRights()->attach($right_id, [
                        'type'    => 'approval_rights',
                        'odr_app' => 1
                    ]);
                }
            }
        }
    }


    private function saveSaleRights(?Product $product, string $sale_rights, mixed $companies)
    {

        if (!empty($sale_rights)) {

            $product->saleRights()->detach();

            if ($sale_rights === 'full_disclosure') {
                $product->update(['sale_rights_disclosure' => 'full']);
                $companies = Company::all()->pluck('id')->toArray();
            } else {
                $product->update(['sale_rights_disclosure' => 'partial']);
            }

            foreach ($companies as $cid) {
                $company = Company::find($cid);
                if ($company && $company->productRights()->exists()) {
                    $product->saleRights()->attach($cid, [
                        'type'    => 'sale_rights',
                        'odr_app' => $company->productRights()->max('odr_app') + 1
                    ]);
                } else {
                    $product->saleRights()->attach($cid, [
                        'type'    => 'sale_rights',
                        'odr_app' => 1
                    ]);
                }
            }
        }
    }
}
