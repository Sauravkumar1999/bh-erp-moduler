<?php

use Modules\Product\Entities\Product;

if (!function_exists('sanitize_data')) {

    function sanitize_data($data)
    {
        return isset($data) ? $data : '';

    }

}

/***
 * Get all products ids with full approval rights
 *
 **/
if (!function_exists('full_approval_right_disclosures')) {

    function full_approval_right_disclosures($full_objects = false)
    {
        return $full_objects ? Product::where('approval_rights_disclosure', 'full')->get() :
            Product::where('approval_rights_disclosure', 'full')->pluck('id')->toArray();

    }

}
