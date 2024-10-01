<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WineStoreFormRequest extends FormRequest
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
            'business_number'      => 'required',
            'available_call_year'  => 'required',
            'available_call_month' => 'required',
            'available_call_day'   => 'required',
            'available_call_hour'  => 'required',
            'terms_and_service1'   => 'accepted',
            'terms_and_service2'   => 'accepted'
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
            'business_number.required'      => 'The business number field is required',
            'available_call_year.required'  => 'The Year field is required',
            'available_call_month.required' => 'The Month field is required',
            'available_call_day.required'   => 'The Day field is required',
            'available_call_hour.required'  => 'The Time field is required',
            'terms_and_service1.accepted'   => 'You must accept terms and service',
            'terms_and_service2.accepted'   => 'You must accept terms and service',
        ];
    }

}
