<?php

namespace Modules\Company\Listeners;

use Modules\Product\Entities\Product;
use Modules\Company\Events\CompanyCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AssignToSalesFullDisclosureProduct
{
    /**
     * Handle the event.
     * Add newly created companies for the products with full_disclosure sales right
     *
     * @param CompanyCreated $event
     * @return void
     */
    public function handle(CompanyCreated $event)
    {
        $company = $event->company;

        if($company->status == 1) {

            Product::where('sale_rights_disclosure', 'full')->each(function ($product) use ($company) {

                if ($company && $company->productRights()->exists()) {
                    $product->saleRights()->attach($company->id, [
                        'type'    => 'sale_rights',
                        'odr_app' => $company->productRights()->max('odr_app') + 1
                    ]);
                } else {
                    $product->saleRights()->attach($company->id, [
                        'type'    => 'sale_rights',
                        'odr_app' => 1
                    ]);
                }

            });
        }

    }
}
