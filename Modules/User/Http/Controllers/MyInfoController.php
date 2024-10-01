<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Modules\User\Entities\Bank;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Media\Traits\MediaHandler;
use Illuminate\Contracts\Support\Renderable;
use Modules\User\Http\Requests\ManageHomepage;
use Modules\User\Http\Requests\UpdateMyInfoRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MyInfoController extends Controller
{
    use MediaHandler;

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return Renderable|\Illuminate\Http\RedirectResponse
     */
    public function edit(User $user)
    {
        // if logged user is not pro admin, user manage page can access to its own user only
        if (!user()->isProAdmin() && auth()->id() != $user->id) {
            return redirect()->route('dashboard');
        }

        $data['banks'] = Bank::all();
        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Users', 'url' => route('admin.users.index')],
            ['name' => 'My Information', 'url' => '#'],
        ];
        return view('user::my-info.edit', compact('user', 'breadcrumbs', 'data'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMyInfoRequest $request
     * @param User $user
     * @return Renderable|\Illuminate\Http\RedirectResponse
     */
    public function update(UpdateMyInfoRequest $request, User $user)
    {
        // abort update if required permissions are not available
        if (!user()->isProAdmin() && auth()->id() != $user->id) {
            abort('401');
        }

        try {
            $request->validated();
            $user->first_name = $request->first_name;
            $user->email = $request->email;
            $user->code = $request->code;
            if ($request->has('password')) {
                $password = $request->input('password');
                if ($password != null) {
                    $user->password = Hash::make($request->password);
                }
            }
            $user->bank_id = $request->bank_id;
            $user->bank_account_no = $request->bank_account_no;
            $user->email = $request->email;
            $user->save();
            $user->contacts()->updateOrCreate(['user_id' => $user->id], [
                // 'telephone_1'    => $request['telephone_1'],
                'post_code'      => $request['post_code'],
                'address'        => $request['address'],
                'address_detail' => $request['address_detail']
            ]);
            if ($request->hasFile('idCard')) {
                $idCardImage = $this->uploadIdCardImage($request->file('idCard'));
                $user->syncMedia($idCardImage, 'idCard');
            }
            return redirect()->back()->withSuccess('Information updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->withError($th->getMessage());
        }
    }

    public function manage(User $user)
    {
        // if logged user is not pro admin, user manage page can access to its own user only
        if (!user()->isProAdmin() && auth()->id() != $user->id) {
            return redirect()->route('dashboard');
        }

        $breadcrumbs = [
            ['name' => 'Home', 'url' => route('dashboard')],
            ['name' => 'Users', 'url' => route('admin.users.index')],
            ['name' => 'Homepage management', 'url' => '#'],
        ];
        $userSetting = $user->userSetting;
        return view('user::my-info.manage', compact('breadcrumbs', 'user', 'userSetting'));
    }


    public function manageUpdate(ManageHomepage $request, User $user)
    {
        // abort update if required permissions are not available
        if (!user()->isProAdmin() && auth()->id() != $user->id) {
            abort('401');
        }

        $userSetting = $user->userSetting()->firstOrNew();
        $userSetting->fill([
            'image_register'    => $request->input('bb'),
            'text_register'     => $request->input('name_status'),
            'email'             => $request->input('contact_email'),
            'telephone'         => $request->input('contact_number'),
            'text_registration' => $request->input('text_registration'),
            'portfolio'         => $request->input('portfolio'),
            'sns'               => $this->prepareSnsData($request),
            // 'product_ordering'  => $this->prepareOrderingData($request) since this is considered as an update and the updated is done 'updateOrder' so need
        ])->save();

        return redirect()->back()->with(['status' => 'success', 'message' => 'Information updated successfully!']);
    }

    private function prepareSnsData(Request $request)
    {
        $all_url = [
            'facebook'  => [
                'status' => $request->input('fa_status'),
                'url'    => $request->input('facebook_url'),
            ],
            'instagram' => [
                'status' => $request->input('in_status'),
                'url'    => $request->input('instagram_url'),
            ],
            'kakaotalk' => [
                'status' => $request->input('ko_status'),
                'url'    => $request->input('kakaotalk_url'),
            ],
            'blog'      => [
                'status' => $request->input('bl_status'),
                'url'    => $request->input('blog_url'),
            ],
        ];
        return json_encode($all_url);
    }

    private function prepareOrderingData(Request $request)
    {
        $ordering_data = array();

        $order = 1;
        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'prod_expose_')) {
                $ordering_data[] = [
                    'product_id' => str_replace('prod_expose_', '', $key),
                    'order'      => $order++,
                    'exposure'   => $value == 'on',
                ];
            }
        }

        return $ordering_data;
    }

    public function updateOrder(Request $request)
    {
        $user = user();
        $newData = $request->input('newData');
        if ($user->userSetting) {
            $user->userSetting()->update(['product_ordering' => $newData]);
        } else {
            return response()->json(['error' => 'User does not have rights to update product order'], 403);
        }

        return response()->json(['message' => 'Order updated successfully'], 200);
    }

    public function updateIdCardImage(Request $request, User $user)
    {
        if ($request->hasFile('file')) {
            $idCardImage = $this->uploadIdCardImage($request->file('file'));
            $user->syncMedia($idCardImage, 'idCard');
        }
    }

    public function salesPersonImage(Request $request, User $user)
    {
        if ($request->hasFile('file')) {
            $salesPersonImg = $this->uploadSalesPerson($request->file('file'));
            $user->syncMedia($salesPersonImg, 'sales-person');
        }
    }
}
