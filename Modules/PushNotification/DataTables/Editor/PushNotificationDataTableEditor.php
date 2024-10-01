<?php

namespace Modules\PushNotification\DataTables\Editor;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\MonthlyNews;
use Modules\PushNotification\Entities\PushNotification;
use Modules\PushNotification\Events\PushNotificationCreated;
use Yajra\DataTables\DataTablesEditor;
use Modules\PushNotification\Http\Controllers\PushNotificationController;
use Modules\PushNotification\Services\FirebaseNotificationService;
use Modules\PushNotification\Services\FirebaseIosNotificationService;

class PushNotificationDataTableEditor extends DataTablesEditor
{
    protected $model = PushNotification::class;


    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            //'key'   => 'required|string|unique:' . $this->resolveModel()->getTable(),
            'title'    => 'required|string',
            'contents'  => 'required|string',
            'receivers'  => 'required|array',
            'receiver_type'  => 'required|numeric', // 1 role 2 user
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

    /**
     * Event hook that is fired before creating a new record.
     *
     * @param \Illuminate\Database\Eloquent\Model $model Empty model instance.
     * @param array $data Attribute values array received from Editor.
     * @return array The updated attribute values array.
     */
    public function creating(Model $model, array $data)
    {
        if (auth()->user()) {
            $data['created_user_id'] = auth()->user()->id;
        }

        return $data;
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
        if ($data['receiver_type'] == 1) //role receiver_type = 1
        {
            // Attaching roles
            $model->roles()->attach($data['receivers']);
        } else {
            // Attaching users
            $model->users()->attach($data['receivers']);
        }

        // event triggering goes here ..
        event(new PushNotificationCreated($model, $data));

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
        return $model;
    }
}
