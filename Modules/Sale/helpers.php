<?php

use Modules\Product\Entities\Product;
use Modules\User\Entities\User;

if (!function_exists('get_auth_products')) {

    /**
     * Get all the products authenticated for logged user.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    function get_auth_products()
    {
        return auth()->user()->isAdmin() ? Product::query()->get() : user()->company->productRights;
    }
}

if (!function_exists('get_auth_users')) {

    /**
     * Get all the users authenticated for logged user.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    function get_auth_users()
    {
        return auth()->user()->isAdmin() ? User::select(['id', 'code', 'first_name', 'last_name'])->get() : user()->company->users;
    }
}

if (!function_exists('get_referral_user')) {

    /**
     * Get referral user of the given user.
     *
     * @param $current_user
     * @return mixed
     */
    function get_referral_user($current_user)
    {
        return User::ancestorsOf($current_user)->last();
    }
}
