<?php

namespace Modules\Sale\Traits;

trait SaleSequenceManager
{
    /**
     * Generate next sale code
     *
     * @return string
     */
    public function getNextSaleCode()
    {
        $prefix = setting('sales.code_prefix', 'S');
        $next = setting('sales.code_next', '1');
        $digit = setting('sales.code_digit', '7');

        return $prefix . str_pad($next, $digit, '0', STR_PAD_LEFT);
    }

    /**
     * Increase the next sale code
     */
    public function increaseNextSaleCode()
    {
        $next = setting('sales.code_next', 1) + 1;

        setting(['sales.code_next' => $next])->save();
    }

}
