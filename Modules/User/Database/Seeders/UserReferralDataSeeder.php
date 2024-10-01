<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\User\Entities\User;

class UserReferralDataSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();
       $contents = file_get_contents(module_path('user', 'Database/factories/user-ref-data.json'));
       $users = json_decode(json: $contents, associative: true);
       foreach ($users as $user) {
           DB::transaction(function () use($user) {
               $cUser = User::where('email', $user['user_email'])->first();
               $recommender = User::where('email', $user['ref_email'])->first();
               if ($cUser && $recommender) {
                   $cUser->appendToNode($recommender)->save();
               }
           });
       }

       if(User::isBroken()) {
           User::fixTree();
       }

    }
}
