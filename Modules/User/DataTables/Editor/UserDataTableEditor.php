<?php

namespace Modules\User\DataTables\Editor;

use Plank\Mediable\Media;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\User\Entities\User;
use Modules\User\Events\UserCreated;
use Modules\User\Events\UserUpdated;
use Yajra\DataTables\DataTablesEditor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Media\Traits\MediaHandler;
use Modules\User\Entities\Contact;
use Modules\User\Traits\UserSequenceManager;


class UserDataTableEditor extends DataTablesEditor
{
    use UserSequenceManager;
    use MediaHandler;

    protected $model = User::class;


    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'name'        => 'required',
            'gender'      => 'required',
            'parent_id'   => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== null) {
                        $exists = User::where('code', $value)->exists();
                        if (!$exists) {
                            $fail(trans('users::users.invalid-recommender'));
                        }
                    }
                },
            ],
            'email'       => 'required|email|unique:' . $this->resolveModel()->getTable(),
            'password'    => 'required|min:8',
            'telephone_1'   => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value !== null) {
                        $exists = Contact::where('telephone_1', preg_replace('/\D/', '', $value))->exists();
                        if ($exists) {
                            $fail(trans('user::user.duplicate-phone'));
                        }
                    }
                },
            ],
            'code'        => 'required|unique:users,code',
            'dob'         => 'required|date_format:' . setting('date_format_php', 'Y-m-d'),
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
            'name' => 'required',

            'email'       => 'sometimes|required|email|' . Rule::unique($model->getTable())->ignore($model->getKey()),
            'password'    => 'nullable|min:8',
            'gender'      => 'required|in:male,female',
            'parent_id'   => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value !== null) {
                        $exists = User::where('code', $value)->exists();
                        if (!$exists) {
                            $fail(trans('users::users.invalid-recommender'));
                        }
                    }
                },
            ],
            'telephone_1'   => [
                'required',
                function ($attribute, $value, $fail) use ($model) {
                    if ($value !== null) {
                        if (!empty($model->contacts[0]?->telephone_1) && $model->contacts[0]?->telephone_1 == $value) {
                            return; 
                        }
                        $exists = Contact::where('telephone_1', preg_replace('/\D/', '', $value))->exists();
                        if ($exists) {
                            $fail(trans('user::user.duplicate-phone'));
                        }
                    }
                },
            ],
            'code'        => 'required',
            'dob'         => 'required|date_format:' . setting('date_format_php', 'Y-m-d'),
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
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        }

        if ($data['parent_id']) {
            $data['recommender'] = $data['parent_id'];
            unset($data['parent_id']);
        }        
        $data['code'] = preg_replace("/[^0-9]/", "", $data['telephone_1']);

        if ($data['name']) {
            $data['first_name'] = $data['name'];
        }
        if ($data['code']) {
            $data['code'] = preg_replace('/\D/', '', $data['code']);
        }
        if ($data['submitted_date'] == null || $data['submitted_date'] == 'N/A') {
            $data['submitted_date'] = null;
            $data['deposit_date'] = null;
            $data['start_date'] = null;
            $data['end_date'] = null;
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
        event(new UserCreated($model, $data));

        if (isset($data['role'])) {
            $roles[] = $data['role'];
            $model->syncRoles($roles);
        }

        $model->contacts()->create([
            'telephone_1' => $data['telephone_1'],
            'address'     => $data['address']
        ]);

        if (isset($data['idCard'])) {
            $media = Media::whereBasename($data['idCard'])->first();
            $model->attachMedia($media, ['idCard']);
        }
        if (isset($data['bankbook'])) {
            $media = Media::whereBasename($data['bankbook'])->first();
            $model->attachMedia($media, ['bankbook']);
        }

        return $model;
    }

    /**
     * Event hook that is fired before updating an existing record.
     *
     * @param \Illuminate\Database\Eloquent\Model $model Model instance retrived
     *  retrived from database.
     * @param array $data Attribute values array received from Editor.
     * @return array The updated attribute values array.
     */
    public function updating(Model $model, array $data)
    {
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($data['parent_id']) {
            $data['recommender'] = $data['parent_id'];
            unset($data['parent_id']);
        }

        if ($data['name']) {
            $data['first_name'] = $data['name'];
        }
        if ($data['code']) {
            $data['code'] = preg_replace('/\D/', '', $data['code']);
        }

        // if ($data['submitted_date'] == null || $data['submitted_date'] == 'N/A') {
            // $data['submitted_date'] = null;
            // $data['deposit_date'] = null;
            // $data['start_date'] = null;
            // $data['end_date'] = null;
        // }else{
        //     $data['end_date'] = Carbon::parse($data['end_date'])->setTime(23, 59, 59);
        // }

        // Handle null or 'N/A' cases for dates
        if ($data['submitted_date'] == null || $data['submitted_date'] == 'N/A') {
            $data['submitted_date'] = null;
        } else {
            // Format the submitted_date to only include the date part
            if($data['deposit_date'] != null){
                $data['deposit_date'] = Carbon::parse($data['deposit_date'])->format('Y-m-d H:i:s') ?? null;
                $data['end_date'] = Carbon::parse($data['end_date'])->setTime(23, 59, 59);
                $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d H:i:s') ?? null;
            }
            $data['submitted_date'] = Carbon::parse($data['submitted_date'])->format('Y-m-d H:i:s') ?? null;
        }

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
        if (isset($data['role'])) {
            $roles[] = $data['role'];
            $model->syncRoles($roles);
        }
        $model->contacts()->updateOrCreate(['user_id' => $model->id], [
            'telephone_1' => $data['telephone_1'],
            'address'     => $data['address']
        ]);

        if (isset($data['bankbook'])) {
            $media = Media::whereBasename($data['bankbook'])->first();
            if ($media) {
                $model->syncMedia($media, 'bankbook');
            } else {
                $existingMedia = $model->getMedia('bankbook');
                if ($existingMedia->isNotEmpty()) {
                    $model->syncMedia($existingMedia, 'bankbook');
                }
            }
        }
        if (isset($data['idCard'])) {
            $media = Media::whereBasename($data['idCard'])->first();
            if ($media) {
                $model->syncMedia($media, 'idCard');
            } else {
                $existingMedia = $model->getMedia('idCard');
                if ($existingMedia->isNotEmpty()) {
                    $model->syncMedia($existingMedia, 'idCard');
                }
            }
        }

        event(new UserUpdated($model, $data));

        return $model;
    }

    public function upload(Request $request): \Illuminate\Http\JsonResponse
    {
        $file = $request->file('upload');
        $field = $request->input('uploadField');
        try {
            if ($field == 'bankbook') {
                $media = $this->uploadBankbookImage($file);
            } else {
                $media = $this->uploadIdCardImage($file);
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
