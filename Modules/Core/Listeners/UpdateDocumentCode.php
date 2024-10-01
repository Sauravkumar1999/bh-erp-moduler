<?php

namespace Modules\Core\Listeners;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Core\Events\DocCodeUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateDocumentCode
{

    /**
     * Handle the event.
     *
     * @param DocCodeUpdated $event
     * @return void
     */
    public function handle(DocCodeUpdated $event)
    {
        if ($event->setting && $event->setting->is_doc) {
            $setting = $event->setting;
            $table = Str::of($setting->key)->explode('.')->first();

            if (!$this->cleanTable($table)) {
                $column = Config::get('core.code_column');
                $digit = setting($table . '.' . Config::get('core.code_digit'));
                $prefix = setting($table . '.' . Config::get('core.code_prefix'));

                $result = DB::select('CALL update_doc_code(?, ?, ?, ?, @code_next);', [$table, $column, $prefix, $digit]);

                if ($result) {
                    setting([$table . '.' . Config::get('core.code_next') => $result[0]->code_next])->save();
                }
            }

        }
    }


    private function cleanTable($table)
    {
        $result = DB::select('SELECT EXISTS (SELECT 1 FROM ' . $table . ') AS tbl_stat;');

        if ($result) {
            return !((bool)$result[0]->tbl_stat);
        }
        return true;
    }
}
