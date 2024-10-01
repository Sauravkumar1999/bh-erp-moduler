<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\Company\Entities\Company;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Plank\Mediable\Facades\MediaUploader;
use Plank\Mediable\Media;

class UserImageSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();

        $contents = file_get_contents(module_path('user', 'Database/factories/user-images.json'));
        $records = json_decode(json: $contents, associative: true);

        foreach ($records as $record) {

            $user = User::where('email', $record['email'])->first();
            if ($user) {
                $existingMedia = $user->getMedia($record['tag'])->first();
                if (!$existingMedia) {
                    $imagePath = public_path('old_images/'. $record['mediable_id'].'/' . $record['filename'] . '.' . $record['extension']);
                    if (File::exists($imagePath)) {
                        $media = MediaUploader::fromSource($imagePath)
                            ->toDisk(Config::get('media.drive'))
                            ->toDirectory(strtolower($record['tag']) == 'idcard' ? 'IdCard' : strtolower($record['tag']))
                            ->useHashForFilename()
                            ->upload();
        
                        $user->attachMedia($media, $record['tag']);
                    }
                }
            
            }
        }

    }
}
