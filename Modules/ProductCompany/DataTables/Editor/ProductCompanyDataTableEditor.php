<?php

namespace Modules\ProductCompany\DataTables\Editor;

use Illuminate\Http\Request;
use Modules\ProductCompany\Traits\ManageProductCompanySquence;
use Modules\Media\Traits\MediaHandler;
use Plank\Mediable\Media;
use Yajra\DataTables\DataTablesEditor;
use Illuminate\Database\Eloquent\Model;
use Modules\ProductCompany\Entities\ProductCompany;
use Modules\ProductCompany\Events\ProductCompanyCreated;

class ProductCompanyDataTableEditor extends DataTablesEditor
{
    use MediaHandler, ManageProductCompanySquence;

    protected $model = ProductCompany::class;

    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'name'                => 'required',
            'logo'                => '',
            'representative_name' => 'required',
            'registration_number' => 'required',
            'address'             => 'required',
            'contract'            => '',
            'status'              => 'required',
            // 'url'  => 'required|url',
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
            'name'                => 'sometimes|required',
            'logo'                => '',
            'representative_name' => 'required',
            'registration_number' => 'required',
            'address'             => 'required',
            'contract'            => '',
            'status'              => 'required',
            // 'url'  => 'sometimes|required|url',
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
        // $data['code'] = $this->getProductCompanyNextCode();

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
        // event(new ProductCompanyCreated($model));
        // $this->increaseNextProductCompanyCode();

        if (isset($data['logo'])) {
            $logoMedia = Media::whereBasename($data['logo'])->first();
            $model->attachMedia($logoMedia, 'logo');
        }

        if (isset($data['contract'])) {
            $contractMedia = Media::whereBasename($data['contract'])->first();
            $model->attachMedia($contractMedia, 'contract');
        }

        return $model;
    }


    public function updated(Model $model, array $data)
    {
        if (isset($data['logo'])) {
            $logoMedia = Media::whereBasename($data['logo'])->first();
            $this->syncMediaIfNotNull($model, $logoMedia, 'logo');

        }

        if (isset($data['contract'])) {
            $contractMedia = Media::whereBasename($data['contract'])->first();
            $this->syncMediaIfNotNull($model, $contractMedia, 'contract');

        }

        return $model;
    }


    public function syncMediaIfNotNull($model, $media, $collection)
    {
        if ($media !== null) {
            $model->syncMedia($media, $collection);
        } else {
            $existingMedia = $model->getMedia($collection);
            if ($existingMedia->isNotEmpty()) {
                $model->syncMedia($existingMedia, $collection);
            }
        }
    }

    public function upload(Request $request): \Illuminate\Http\JsonResponse
    {
        $file = $request->file('upload');
        $field = $request->input('uploadField');
        try {
            if ($field === 'contract') {
                $media = $this->uploadProductCompanyContract($file);
            } else {
                $media = $this->uploadProductCompanyImage($file);
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
