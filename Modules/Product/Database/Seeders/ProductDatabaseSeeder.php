<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Product\Traits\ProductSequenceManager;

class ProductDatabaseSeeder extends Seeder
{
    use ProductSequenceManager;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Product::create([
            'code'                          => $this->getNextProductCode(),
            'product_name'                  => '통합 컨설팅 프로그',
            'product_description'           => '통합 컨설팅 프로그램 신청서',
            'product_price'                 => '25.00',
            'commission_type'               => 'fixed-price',
            'main_url'                      => 'Main Url',
            'url_1'                         => 'URL 1',
            'url_2'                         => 'URL 2',
            'urls_open_mode'                => 'same-window',
            'sale_status'                   => 'normal',
            'contact_notifications'         => '1',
        ]);

        Product::create([
            'code'                          => $this->getNextProductCode(),
            'product_name'                  => '통합 컨설팅 프로그',
            'product_description'           => '통합 컨설팅 프로그램 신청서',
            'product_price'                 => '25.00',
            'commission_type'               => 'fixed-price',
            'main_url'                      => 'Main Url',
            'url_1'                         => 'URL 1',
            'url_2'                         => 'URL 2',
            'urls_open_mode'                => 'same-window',
            'sale_status'                   => 'pause',
            'contact_notifications'         => '0',
        ]);

        Product::create([
            'code'                          => $this->getNextProductCode(),
            'product_name'                  => '통합 컨설팅 프로그',
            'product_description'           => '통합 컨설팅 프로그램 신청서',
            'product_price'                 => '25.00',
            'commission_type'               => 'fixed-price',
            'main_url'                      => 'Main Url',
            'url_1'                         => 'URL 1',
            'url_2'                         => 'URL 2',
            'urls_open_mode'                => 'same-window',
            'sale_status'                   => 'stop-selling',
            'contact_notifications'         => '1',
        ]);

        Product::create([
            'code'                          => $this->getNextProductCode(),
            'product_name'                  => '통합 컨설팅 프로그',
            'product_description'           => '통합 컨설팅 프로그램 신청서',
            'product_price'                 => '25.00',
            'commission_type'               => 'fixed-price',
            'main_url'                      => 'Main Url',
            'url_1'                         => 'URL 1',
            'url_2'                         => 'URL 2',
            'urls_open_mode'                => 'same-window',
            'sale_status'                   => 'onetime-sell',
            'contact_notifications'         => '0',
        ]);

        // $this->call("OthersTableSeeder");
    }
}
