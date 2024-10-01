<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class FixBrokenTreeSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        if(User::isBroken()) {
            User::fixTree();
        }
    }
}
