<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;

class UserPasswordSeeder extends Seeder
{
    public function run()
    {
        $contents = file_get_contents(module_path('user', 'Database/factories/user-passwords.json'));
        $records = json_decode(json: $contents, associative: true);
        foreach ($records as $record) {

            DB::transaction(function () use ($record) {

                $user = User::where('email', $record['email'])->first();

                if ($user) {
                    $user->update([
                        'password' => $record['password']
                    ]);
                }
            });
        }
    }

}
