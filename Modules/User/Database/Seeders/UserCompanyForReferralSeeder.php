<?php


namespace Modules\User\Database\Seeders;


// this seeder is used to check the users where don't have any company assigned but having a recommender.
// assign recommender company to that users

use Modules\User\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserCompanyForReferralSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        User::all()->each(function ($user) {

            // check if user has no company and still having a referral user
            if (is_null($user->company_id) && $user->parent_id) {

                // get ref user
                $refUser = User::find($user->parent_id);

                if ($refUser) {
                    $user->update([
                        'company_id' => $refUser->company_id // get ref user company_id
                    ]);
                }
            }

        });

    }
}
