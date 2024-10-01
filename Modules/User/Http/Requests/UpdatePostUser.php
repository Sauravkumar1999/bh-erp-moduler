<?php

namespace Modules\User\Http\Requests;

use App\Http\Requests\FormRequest;

class UpdatePostUser extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'code' => 'required',
            'bank_id' => 'required',
            'bank_account_no' => 'required|string',
            'post_code' => 'required|string',
            'address' => 'required|string',
            'address_detail' => 'nullable|string',
            'telephone_1' => 'required|string',
            'email' => 'required|email',
            'password' => 'required_with:password_confirmation|confirmed|nullable|min:8'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
