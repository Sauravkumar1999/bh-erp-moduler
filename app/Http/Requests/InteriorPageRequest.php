<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InteriorPageRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                 => 'required',
            'contact'              => 'required',
            'organisation'         => 'required',
            'available_call_year'  => 'required',
            'available_call_month' => 'required',
            'available_call_day'   => 'required',
            'available_call_hour'  => 'required',
            'condition1'           => 'accepted',
            'condition2'           => 'accepted',
            recaptchaFieldName()   => recaptchaRuleName(),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'                 => 'The name field is required',
            'contact.required'              => 'The contact field is required',
            'organisation.required'         => 'The organisation field is required',
            'available_call_year.required'  => 'The Year field is required',
            'available_call_month.required' => 'The Month field is required',
            'available_call_day.required'   => 'The Day field is required',
            'available_call_hour.required'  => 'The Time field is required',
            'condition1.accepted'           => 'You must accept terms and service',
            'condition2.accepted'           => 'You must accept terms and service',
        ];
    }
}
