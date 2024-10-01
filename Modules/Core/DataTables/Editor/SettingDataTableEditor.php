<?php

namespace Modules\Core\DataTables\Editor;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Setting;
use Modules\Core\Events\DocCodeUpdated;
use Yajra\DataTables\DataTablesEditor;

class SettingDataTableEditor extends DataTablesEditor
{
    protected $model = Setting::class;

    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            //'key'   => 'required|string|unique:' . $this->resolveModel()->getTable(),
            'key'    => 'required|string',
            'value'  => 'required|string',
            'is_doc' => 'required|boolean',
        ];
    }

    /**
     * Get edit action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function editRules(Model $model)
    {
        return [
            //'key'   => 'required|string|unique:' . Rule::unique($model->getTable())->ignore($model->getKey()),
            'key'    => 'required|string',
            'value'  => 'required|string',
            'is_doc' => 'required|boolean',
        ];
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

    /**
     * Event hook that is fired after a new record is created.
     *
     * @param \Illuminate\Database\Eloquent\Model $model The newly created model.
     * @param array $data Attribute values array received from `creating` or
     *   `saving` hook.
     * @return \Illuminate\Database\Eloquent\Model Since version 1.8.0 it must
     *   return the $model.
     */
    public function created(Model $model, array $data)
    {
        event(new DocCodeUpdated($model));

        return $model;
    }

    /**
     * Event hook that is fired after updating an existing record.
     *
     * @param \Illuminate\Database\Eloquent\Model $model Model instance retrived
     *  retrived from database.
     * @param array $data Attribute values array received from Editor.
     * @return Model
     */
    public function updated(Model $model, array $data)
    {
        event(new DocCodeUpdated($model));

        return $model;
    }
}
