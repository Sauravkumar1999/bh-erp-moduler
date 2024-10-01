<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Rules\PhoneNumber;

class RegisterUser extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'first_name' => 'required|string',
            // 'last_name' => 'required|string',
            'name'            => 'required|string',
            // 'code' => 'required',
            'date_of_birth'   => 'required',
            'bank_id'         => 'nullable|exists:banks,id',
            'bank_account_no' => 'nullable|string',
            'post_code'       => 'required|string',
            'address'         => 'required|string',
            'address_detail'  => 'nullable|string',
            'phone'           => ['required', new PhoneNumber],
            'email'           => 'required|email|unique:users,email',
            // 'password'        => 'required_with:password_confirmation|confirmed|nullable|min:8'
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

    public function messages()
    {
        return [
            'password.required'  => '비밀번호를 입력해주세요.',
            'password.min'       => '비밀번호는 8자 이상이어야 합니다.',
            'password.confirmed' => '비밀번호가 일치하지 않습니다.',
            'email.email'        => '이메일은 유효한 이메일 주소여야 합니다',
            'email.unique'       => '이미 사용중인 이메일입니다.',
            'post_code.required' => '주소를 검색해주세요.',
            'address.required'   => '주소를 검색해주세요.',
            'phone.required'     => '주소를 검색해주세요.',
            'name.required'      => '주소를 검색해주세요.',
        ];
    }

    public function attributes()
    {
        return [
            'name'           => '성명',
            'email'          => '아이디',
            'password'       => '비밀번호',
            'bank_name'      => '수당 계좌 번호',
            'account_number' => '계좌번호',
            'address'        => '주소',
            'phone'          => '휴대전화',
        ];
    }
}
