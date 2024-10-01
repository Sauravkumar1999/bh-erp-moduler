<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Company\Entities\Company;
use Modules\User\Entities\Contact;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;

class UserContactSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        $contents = file_get_contents(module_path('user', 'Database/factories/user-contact.json'));
        $records = json_decode(json: $contents, associative: true);
        foreach ($records as $record) {
            DB::transaction(function () use ($record) {
                $user = User::where('email', $record['email'])->first();
                $contact = null;
                if ($user) {
                    $contact = Contact::where('user_id', $user->id)->first();
                }

                if ($user) {
                    if (!$contact) {
                        Contact::create([
                            'telephone_1' => $record['phone'],
                            'address' => $record['address'],
                            'post_code' => $record['post_code'],
                            'address_detail' => $record['address_detail'],
                            'user_id' => $user->id,

                        ]);
                    }
                }
            });
        }
        foreach (User::withTrashed()->get() as $user) {
            try {
            DB::transaction(function () use ($user) {
                $contact = Contact::withTrashed()->where('user_id', $user->id)->first();
                if ($contact) {
                    $phoneNumber = preg_replace('/^\+82\s*10[-\s]?/', '010', $contact->telephone_1);
                    // Remove leading '082' if present
                    $phoneNumber = preg_replace('/^08210/', '010', $phoneNumber);
                    // Remove all hyphens and spaces
                    $phoneNumber = preg_replace('/[-\s]/', '', $phoneNumber);

                   $contact->update([
                        'telephone_1' => $phoneNumber,
                    ]);
                }
            });
        } catch (\Exception $e) {
            dd($e);
        }
        }
    }
}
