<?php

namespace Modules\Sale\DataTables\Editor;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Media\Traits\MediaHandler;
use Plank\Mediable\Media;
use Yajra\DataTables\DataTablesEditor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Sale\Entities\Sale;

class SaleDataTableEditor extends DataTablesEditor
{
    use MediaHandler;

    protected $model = Sale::class;

    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [];
    }

    /**
     * Get edit action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function editRules(Model $model)
    {
        return [];
    }

    /**
     * Get remove action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function removeRules(Model $model)
    {
        return [];
    }

}
