<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\User\Entities\Permission;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Modules\User\Events\UserCreated;
use Modules\User\Traits\UserSequenceManager;

class DeveloperSeeder extends Seeder
{

    use UserSequenceManager;

    /**
     * Run the developer seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        // create the developer user
        $user = User::create([
            'first_name' => 'Developer',
            'email'      => 'developer@developer.com',
            'code'       => $this->getNextUserCode(),
            'password'   => bcrypt('123developer@123'),
            'dob'        => date('Y-m-d'),
            'status'     => 1
        ]);

        event(new UserCreated($user, []));

        $developerRole = Role::find(1);

        // add role to the user
        $user->attachRole($developerRole);

        // add all permissions to the developer
        foreach (Permission::all() as $permission) {
            $developerRole->attachPermission($permission);
        }
    }
}
