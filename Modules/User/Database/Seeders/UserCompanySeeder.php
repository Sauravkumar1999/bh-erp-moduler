<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Company\Entities\Company;
use Modules\User\Entities\User;

class UserCompanySeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        $contents = file_get_contents(module_path('user', 'Database/factories/usr-com.json'));
        $records = json_decode(json: $contents, associative: true);
        foreach ($records as $record) {
            DB::transaction(function () use ($record) {
                $user = User::where('email', $record['email'])->first();
                $company = Company::where('name', $record['name'])->first();
                if (!$company) {
                    $lastCode = Company::orderBy('code', 'desc')->pluck('code')->first();
                    $lastNumber = intval(substr($lastCode, 1));
                    $newNumber = $lastNumber + 1;
                    $newCode = 'C' . str_pad($newNumber, strlen($lastCode) - 1, '0', STR_PAD_LEFT);

                    $company = Company::create([
                        'name' => $record['name'],
                        'code' => $newCode,
                        'status' => '1'
                    ]);
                }
                if ($user && $company) {
                    $user->update([
                        'company_id' => $company->id
                    ]);
                }
            });
        }
    }
}
