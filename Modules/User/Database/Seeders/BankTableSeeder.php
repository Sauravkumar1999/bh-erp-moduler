<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Bank;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $banks = [
            ['bank_name' => '국민은행', 'display_name' => '국민은행', 'status' => 1],
            ['bank_name' => '기업은행', 'display_name' => '기업은행', 'status' => 1],
            ['bank_name' => 'NH농협은행', 'display_name' => 'NH농협은행', 'status' => 1],
            ['bank_name' => '신한은행', 'display_name' => '신한은행', 'status' => 1],
            ['bank_name' => '우리은행', 'display_name' => '우리은행', 'status' => 1],
            ['bank_name' => '하나은행', 'display_name' => '하나은행', 'status' => 1],
            ['bank_name' => '씨티은행', 'display_name' => '씨티은행', 'status' => 1],
            ['bank_name' => 'SC제일은행', 'display_name' => 'SC제일은행', 'status' => 1],
            ['bank_name' => '경남은행', 'display_name' => '경남은행', 'status' => 1],
            ['bank_name' => '광주은행', 'display_name' => '광주은행', 'status' => 1],
            ['bank_name' => '대구은행', 'display_name' => '대구은행', 'status' => 1],
            ['bank_name' => '부산은행', 'display_name' => '부산은행', 'status' => 1],
            ['bank_name' => '산림조합', 'display_name' => '산림조합', 'status' => 1],
            ['bank_name' => '산업은행', 'display_name' => '산업은행', 'status' => 1],
            ['bank_name' => '수협', 'display_name' => '수협', 'status' => 1],
            ['bank_name' => '신협', 'display_name' => '신협', 'status' => 1],
            ['bank_name' => '우체국', 'display_name' => '우체국', 'status' => 1],
            ['bank_name' => '저축은행', 'display_name' => '저축은행', 'status' => 1],
            ['bank_name' => '새마을금고', 'display_name' => '새마을금고', 'status' => 1],
            ['bank_name' => '카카오뱅크', 'display_name' => '카카오뱅크', 'status' => 1],
            ['bank_name' => '케이뱅크', 'display_name' => '케이뱅크', 'status' => 1],
            ['bank_name' => '토스뱅크', 'display_name' => '토스뱅크', 'status' => 1],
        ];
        foreach ($banks as $bank) {
            if (!Bank::where('bank_name', $bank['bank_name'])->exists()) {
                Bank::create($bank);
            }
        }

        // $this->call("OthersTableSeeder");
    }
}
