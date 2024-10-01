<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageHomepage extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($this->request);
        return [
            'text_registration' => "required_if:name_status, '=', 1",
            'contact_number'    => 'required',
            'contact_email'     => 'required',
            'portfolio'         => 'nullable',
            'facebook_url'      => "required_if:fa_status, '=', 1",
            'instagram_url'     => "required_if:in_status, '=', 1",
            'kakaotalk_url'     => "required_if:ko_status, '=', 1",
            'blog_url'          => "required_if:bl_status, '=', 1",
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


    /**
     * @return $message
     */

    public function messages()
    {
        return [
            'text_registration.required_if' => trans('user::my-info.name-required-when-status-on'),
            'contact_number.required'       => trans('user::my-info.contact-number-required'),
            'portfolio.required'            => trans('user::my-info.portfolio-required'),
            'facebook_url.required_if'      => trans('user::my-info.facebook-url-required'),
            'instagram_url.required_if'     => trans('user::my-info.instagram-url-required'),
            'kakaotalk_url.required_if'     => trans('user::my-info.kakaotalk-url-required'),
            'blog_url.required_if'          => trans('user::my-info.blog-url-required'),
        ];
    }
}
