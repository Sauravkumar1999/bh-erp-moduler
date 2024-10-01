<?php

namespace Modules\User\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMyInfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'      => 'required',
            'code'            => 'required',
            // 'bank_id'         => 'required',
            // 'bank_account_no' => 'required|string',
            'post_code'       => 'required|string',
            'address'         => 'required|string',
            'address_detail'  => 'nullable|string',
            'telephone_1'     => 'required|string',
            'email'           => ['required', 'email', Rule::unique('users')->ignore($this->user()->id)],
            'password'        => Rule::when($this->filled('password'), [
                'confirmed', 'min:8', 'regex:/[a-zA-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'
            ])
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return user()->hasPermission('update-my-info');
    }

    public function messages()
    {
        return [
            'first_name.required'      => trans('user::validation.name-required'),
            'code.required'            => trans('user::validation.code-required'),
            // 'bank_id.required'         => trans('user::validation.bank-required'),
            // 'bank_account_no.required' => trans('user::validation.bank-account-required'),
            'post_code.required'       => trans('user::validation.post-code-required'),
            'address.required'         => trans('user::validation.address-required'),
            'telephone_1.required'     => trans('user::validation.telephone-required'),
            'email.required'           => trans('user::validation.email-required'),
            'email.unique'             => trans('user::validation.email-unique'),
            'password.confirmed'       => trans('user::validation.password-confirmed'),
            'password.min'             => trans('user::validation.password-min-letters'),
            'password.regex'           => trans('user::validation.password-content'),
        ];
    }
}
