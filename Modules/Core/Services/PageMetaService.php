<?php

namespace Modules\Core\Services;

use Modules\Core\Entities\PageMeta;

class PageMetaService
{
    public function save(array $data, PageMeta $pagemeta = null): PageMeta
    {
        if (!$pagemeta) {
            $pagemeta = new PageMeta();
        }
        $pagemeta->meta_information = $data['meta_information'];
        $pagemeta->page_url =  $data['page_url'];
        $pagemeta->status = $data['status'];
        $pagemeta->save();
        return $pagemeta;
    }
}
