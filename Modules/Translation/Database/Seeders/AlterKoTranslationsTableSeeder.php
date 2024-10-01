<?php

namespace Modules\Translation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Translation\Entities\Translation;

class AlterKoTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This used to alter KO unicode translations
     * DON'T USE it
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $translations = Translation::all();

        foreach ($translations as $translation) {
            if (isset($translation->text['ko'])) {
                DB::table('translations')->where('id', $translation->id)
                    ->update([
                        'text->ko' => $translation->text['ko']
                    ]);
            }
        }
    }
}
