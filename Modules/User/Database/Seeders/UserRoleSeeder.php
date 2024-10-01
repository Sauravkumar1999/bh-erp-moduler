<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Company\Entities\Company;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;

class UserRoleSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

       $contents = file_get_contents(module_path('user', 'Database/factories/usr-role.json'));
       $records = json_decode(json: $contents, associative: true);
       foreach ($records as $record) {
           DB::transaction(function () use($record) {
               $user = User::where('email', $record['email'])->first();
               $role = Role::where('name', $record['role'])->first();

               if($user && $role) {
                $user->roles()->sync($role->id);
               }
           });
       }
    }
}
