<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as FormRequestOrig;
use Illuminate\Contracts\Validation\Validator;

class FormRequest extends FormRequestOrig
{
    public function failedValidation(Validator $validator)
    {
        return redirect()->back()->withInput()->withErrors($validator);
    }
}
