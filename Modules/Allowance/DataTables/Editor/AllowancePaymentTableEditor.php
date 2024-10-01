<?php

namespace Modules\Allowance\DataTables\Editor;

use Illuminate\Http\Request;
use Modules\Media\Traits\MediaHandler;
use Plank\Mediable\Media;
use Yajra\DataTables\DataTablesEditor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Allowance\Entities\AllowancePayment;

class AllowancePaymentTableEditor extends DataTablesEditor
{
    use MediaHandler;

    protected $model = AllowancePayment::class;


    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'title'      => 'required',
            'detail'     => 'required',
            'attachment' => 'nullable',
            'user_id'    => 'nullable',
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
            'title'      => 'required|string|max:255',
            'detail'     => 'required|string',
            'attachment' => 'nullable',
            'user_id'    => 'nullable',
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
     * Event hook that is fired before creating a new record.
     *
     * @param \Illuminate\Database\Eloquent\Model $model Empty model instance.
     * @param array $data Attribute values array received from Editor.
     * @return array The updated attribute values array.
     */
    public function creating(Model $model, array $data)
    {

        $data['user_id'] = auth()->id();
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

        // event(new BulletinCreated($model));

        if (isset($data['attachment'])) {
            $attachment = Media::whereBasename($data['attachment'])->first();
            $model->attachMedia($attachment, 'allowance-payment');
        }
        return $model;
    }

    public function updating(Model $model, array $data)
    {
        return $data;
    }


    /**
     * Event hook that is fired after updating an existing record.
     *
     * @param \Illuminate\Database\Eloquent\Model $model Model instance retrieved
     *  retrieved from the database.
     * @param array $data Attribute values array received from Editor.
     * @return Model
     */
    public function updated(Model $model, array $data)
    {
        if (!isset($data['attachment'])) {
            if ($model->hasMedia('allowance-payment')) {
                $media= $model->getMedia('allowance-payment')->first();
                $model->detachMedia($media, 'allowance-payment');
            }
        }
        if (isset($data['attachment'])) {
            $media = Media::whereBasename($data['attachment'])->first();
            if ($media) {
                $model->syncMedia($media, 'allowance-payment');
            } else {
                $existingMedia = $model->getMedia('allowance-payment');
                if ($existingMedia->isNotEmpty()) {
                    $model->syncMedia($existingMedia, 'allowance-payment');
                }
            }
        }
        return $model;
    }

    public function upload(Request $request): \Illuminate\Http\JsonResponse
    {
        $file = $request->file('upload');
        $field = $request->input('uploadField');
        try {
            $media = $this->uploadAllowancePayment($file);
            return response()->json([
                'action' => 'upload',
                'data'   => [],
                'files'  => [
                    'files' => [
                        $media->filename => [
                            'filename'      => $media->filename,
                            'original_name' => $media->basename,
                            'size'          => $media->size,
                            'directory'     => $media->directory,
                            'disk'          => $media->disk,
                            'url'           => $media->getUrl(),
                        ],
                    ],
                ],
                'upload' => [
                    'id' => $media->basename,
                ],
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'action'      => $this->action,
                'data'        => [],
                'fieldErrors' => [
                    [
                        'name'   => $field,
                        'status' => str_replace('upload', $field, $exception->getMessage()),
                    ],
                ],
            ]);
        }
    }
}
