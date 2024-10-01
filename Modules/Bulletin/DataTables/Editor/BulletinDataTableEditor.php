<?php

namespace Modules\Bulletin\DataTables\Editor;

use Illuminate\Http\Request;
use Modules\Bulletin\Events\BulletinCreated;
use Modules\Bulletin\Entities\Bulletin;
use Modules\Media\Traits\MediaHandler;
use Plank\Mediable\Media;
use Yajra\DataTables\DataTablesEditor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BulletinDataTableEditor extends DataTablesEditor
{
    use MediaHandler;

    protected $model = Bulletin::class;


    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'title'     => 'required',
            'content'   => 'required',
            'attachment' => 'nullable',
            'permission' => [
                'required',
                'array',
            ],
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
            'title'         => 'required|string|max:255',
            'content'       => 'required|string',
            'attachment'    => 'nullable',
            'permission'    => [
                'required',
                'array',
            ],
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
        $data['permission'] = json_encode($data['permission']);
        $data['user_id']  = Auth::user()->id;
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

        event(new BulletinCreated($model));

        if (isset($data['attachment'])) {
            $logoMedia = Media::whereBasename($data['attachment'])->first();
            $model->attachMedia($logoMedia, 'attachment');
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
        
        if (isset($data['attachment'])) {
            $media = Media::whereBasename($data['attachment'])->first();
            if ($media) {
                $model->syncMedia($media, 'attachment');
            } else {
                $existingMedia = $model->getMedia('attachment');
                if ($existingMedia->isNotEmpty()) {
                    $model->syncMedia($existingMedia, 'attachment');
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
            if ($field === 'bulletin') {
                $media = $this->uploadPostImage($file);
            } else {
                $media = $this->uploadPostImage($file);
            }
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
