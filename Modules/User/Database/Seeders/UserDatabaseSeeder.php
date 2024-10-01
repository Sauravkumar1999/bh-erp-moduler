<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $email = "developer@developer.com";

        if (!User::where('email', $email)->exists()) {
            $user = new User;
            $user->code = 'U00001';
            $user->first_name = 'System';
            $user->last_name = 'Developer';
            $user->email = $email;
            $user->password = bcrypt('123developer@123');
            $user->status = 1;
            $user->save();
        }
        $contents = file_get_contents(module_path('user', 'Database/factories/usr.json'));
        $records = json_decode(json: $contents, associative: true);
        foreach ($records as $record) {
            DB::transaction(function () use ($record) {
                $user = User::where('email', $record['email'])->first();
                if (!$user) {
                    $user = User::create([
                        'first_name' => $record['name'],
                        'email' => $record['email'],
                        'dob' => $record['date_of_birth'],
                        'gender' => $record['gender'],
                        'bank_account_no' => $record['account_number'],
                        'code' => $record['member_id'],
                        'password' => Hash::make('businesshub'),
                        'final_confirmation' => $record['final_confirmation'],
                    ]);
                } else {
                    $user->update([
                        'first_name' => $record['name'],
                        'dob' => $record['date_of_birth'],
                        'gender' => $record['gender'],
                        'bank_account_no' => $record['account_number'],
                        'final_confirmation' => $record['final_confirmation'],
                    ]);
                }
            });
        }

        // $this->call("OthersTableSeeder");
    }
}
