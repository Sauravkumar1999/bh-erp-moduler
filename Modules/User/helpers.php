<?php

use Illuminate\Support\Carbon;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Modules\Product\Entities\Product;
use Modules\Company\Entities\Company;

if (!function_exists('user')) {
    /**
     * Get the authenticated user.
     *
     * @return User
     */
    function user()
    {
        // Get user from api/web
        if (request()->is('api/*')) {
            $user = auth()->guard('api')->user();
        } else {
            $user = auth()->user();
        }

        return $user;
    }
}

if (!function_exists('roles')) {
    /**
     * Get all roles for dropdown select.
     *
     * @param bool $flip
     * @param bool $no_dev
     * @return array
     */
    function roles($flip = false, $no_dev = true)
    {
        $query = Role::query();

        $query->when($no_dev, function ($q) {
            return $q->whereNotIn('name', ['developer']);
        });

        $array = $query->get()->pluck('display_name', 'id')->toArray();

        return $flip ? array_flip($array) : $array;
    }
}

if (!function_exists('companies')) {
    /**
     * Get all companies for dropdown select.
     *
     * @param bool $flip
     * @return array
     */
    function companies($flip = false)
    {
        $companies = Company::all()->toArray();

        return $flip ? array_flip($companies) : $companies;
    }
}


if (!function_exists('userRole')) {
    /**
     * Get all roles for dropdown select.
     *
     * @param bool $flip
     * @return array
     */
    function userRole(bool $flip = false)
    {
        $roles = Role::all()->toArray();

        return $flip ? array_flip($roles) : $roles;
    }
}

if (!function_exists('merge_user_settings')) {

    /**
     * Merge user settings into the member company product listing
     *
     * @param User $user
     * @param \Illuminate\Database\Eloquent\Collection $products
     * @return \Illuminate\Support\Collection
     */

    function merge_user_settings(User $user, \Illuminate\Database\Eloquent\Collection $products)
    {
        $max_product_order = 0;

        return $products->collect()->map(function (Product $prod) use ($user, &$max_product_order) {

            if (!empty($prod->url_params)) {

                $urlService = new \Modules\Product\Services\ProductURLGeneratorService();
                $main_url = isset($prod->main_url) ? $urlService->createURL($prod, $user) : '';

            } else {

                $main_url = isset($prod->main_url) ? $prod->main_url . '?bhid=' . $user->code : '';
            }

            if (($user->userSetting && $user->userSetting->product_ordering) && in_array($prod->id, array_column($user->userSetting->product_ordering, 'product_id'))) {

                $aData = current(\Illuminate\Support\Arr::where($user->userSetting->product_ordering, fn($v, $k) => $v['product_id'] == $prod->id));

                $adminUserSettings = $prod->adminUserSettings()->wherePivot('user_id', $user->id);

                if ($adminUserSettings->exists()) {
                    $adminUserSetting = $adminUserSettings->first();
                    if (!empty($adminUserSetting->pivot->url) && $adminUserSetting->pivot->status) {
                        $main_url = $adminUserSetting->pivot->url;
                    }
                }

                return array_merge($prod->toArray(), [
                    'odr_app'  => $aData['order'] ?? 0,
                    'exposure' => $aData['exposure'] ?? 0,
                    'url'      => $aData['url'] ?? '',
                    'main_url' => $main_url,
                ]);

            } else {
                if ($user->userSetting && $user->userSetting->product_ordering) {
                    $cur_max = max(array_column($user->userSetting->product_ordering, 'order')) ?? 0;

                    if ($cur_max > $max_product_order) {
                        $max_product_order = $cur_max;
                    }
                    $max_product_order++;

                    // Update the product_ordering array
                    $product_ordering = $user?->userSetting?->product_ordering ?? [];
                    $product_ordering[] = [
                        'product_id' => $prod->id,
                        'order'      => $max_product_order,
                        // 'exposure'   => false,
                        // 'main_url'   => '',
                    ];

                    $user->userSetting->product_ordering = $product_ordering;
                    $user->userSetting->save();
                } else {
                    $max_product_order = $prod->exposer_order;
                }


                $adminUserSettings = $prod->adminUserSettings()->wherePivot('user_id', $user->id);

                if ($adminUserSettings->exists()) {
                    $adminUserSetting = $adminUserSettings->first();
                    if (!empty($adminUserSetting->pivot->url) && $adminUserSetting->pivot->status) {
                        $main_url = $adminUserSetting->pivot->url;
                    }
                }

                return array_merge($prod->toArray(), [
                    'odr_app'  => $max_product_order ?? 'new',
                    'exposure' => false,
                    'url'      => '',
                    'main_url' => $main_url,
                ]);
            }
        })->sortBy('odr_app');

    }

}

if (!function_exists('merge_all_product_data')) {

    function merge_all_product_data(\Illuminate\Database\Eloquent\Collection $prodUserSettings)
    {

        return Product::all()->collect()->map(function (Product $prod) use ($prodUserSettings) {

            if ($prodUserSettings->where('id', $prod->id)->isEmpty()) {

                return array_merge($prod->toArray(), [
                    'p_url'    => '',
                    'p_status' => 1,
                ]);

            } else {

                $prdSetting = $prodUserSettings->where('id', $prod->id)->first();

                return array_merge($prod->toArray(), [
                    'p_url'    => $prdSetting->pivot->url,
                    'p_status' => $prdSetting->pivot->status,
                ]);
            }

        });

    }
}

if (!function_exists('is_admin_user')) {

    /**
     * Check logged user or user passed via URL is admin
     *
     * @return boolean
     */
    function is_admin_user()
    {
        if (auth()->check()) {
            return user()->isAdmin();
        } else {
            $user = User::whereCode(last(request()->segments()));
            return $user->exists() ? $user->first()->hasRole('admin|developer|chief') : false;
        }

    }

}

if (!function_exists('login_redirect_url')) {

    /**
     * Redirect URL after user login success
     * @return string
     */
    function login_redirect_url(): string
    {
        return user()->isAdmin() ? route('admin.users.index') : route('admin.my-info.edit', ['user' => auth()->user()]);
    }
}

if (!function_exists('sales_person_url')) {

    /**
     * Get the sales person URL pattern
     * This is the URL pattern requested by the client. And anyone comes with this url will redirect to bh erp route('sales.page')
     * @param $user_code
     * @return string
     */
    function sales_person_url($user_code): string
    {
        // if short url assigned in settings and also the app env is production
        if (setting('short_url', null) && app()->environment('production')) {
            return setting('short_url', 'https://bzhub.kr/') . $user_code;
        }
        return route('home') . '/?bhid=' . $user_code;
    }
}

if (!function_exists('arrange_telephone')) {


    function arrange_telephone($telephone)
    {

        return \Illuminate\Support\Str::replace('-', '', $telephone);
    }
}

if (!function_exists('is_royal_member')) {

    /**
     * Check logged user or user passed via URL is admin
     *
     * @return boolean
     */
    function is_royal_member($user = '')
    {
        $currentUser = ($user == '') ? user() : $user;
        if (now() >= $currentUser->start_date && now() <= $currentUser->end_date){
            return true;
        }
        return false;
    }

}
if (!function_exists('is_royal_application')) {

    /**
     * Check logged user or user passed via URL is admin
     *
     * @return boolean
     */
    function is_royal_application()
    {
        if (isset(user()->submitted_date) && user()->submitted_date != null){
            return true;
        }
        return false;
    }
}

if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber($phoneNumber,$response = '')
    {
        if(!$phoneNumber){
            return $response;
        }
        // Remove any non-numeric characters from the phone number
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Format the phone number
        $formattedPhoneNumber = substr($phoneNumber, 0, 3) . '-' . substr($phoneNumber, 3, 4) . '-' . substr($phoneNumber, 7);

        return $formattedPhoneNumber;
    }
}
if (!function_exists('formatDate')) {
    function formatDate($date,$formate ='Y-m-d')
    {
        return Carbon::parse($date)->format(setting('date_format_php', $formate));
    }
}
if (!function_exists('remainingDays')) {
    function remainingDays($end_date)
    {
        if($end_date){
            $endDate = Carbon::parse($end_date);
            return $endDate->diffInDays(Carbon::now());
        }
        return '0';
    }
}
