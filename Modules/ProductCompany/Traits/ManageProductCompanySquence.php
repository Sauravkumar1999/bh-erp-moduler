<?php

namespace Modules\ProductCompany\Traits;


trait ManageProductCompanySquence
{

    /**
     * Generate ProductCompany next code
     * @return string
     */
    public function getProductCompanyNextCode()
    {
        $prefix = setting('productcompany.code_prefix', 'PC');
        $next = setting('productcompany.code_next', '1');
        $digit = setting('productcompany.code_digit', '3');
        return $prefix . str_pad($next, $digit, '0', STR_PAD_LEFT);
    }


    /**
     * Increase the next ProductCompany code
     */
    public function increaseNextProductCompanyCode()
    {
        $next = setting('productcompany.code_next', 1) + 1;
        setting(['productcompany.code_next' => $next])->save();
    }

}
