<?php

namespace App\Http\Controllers\Product\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;
use App\Rules\NumberFormatRule;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "product_name"          => "required|string",
            'productcompany_id'     => 'required|exists:product_companies,id',
            "user_id"               => 'required|exists:users,id',
            "sale_rights"           => "required",
            "approval_rights"       => "required|array",
            "commission_type"       => "required",
            "product_description"   => "required",
            "other_fees"            => 'required|between:0,9999999.99|regex:/^[\d\.,]+$/',
            // "bh_operating_profit"   => 'required|between:0,9999999.99',
            "product_price"         => 'required|between:0,9999999.99',
            "bp"                    => ['required', 'between:0,9999999.99', new NumberFormatRule($this->getFormatPattern())],
            "ba"                    => ['required', 'between:0,9999999.99', new NumberFormatRule($this->getFormatPattern())],
            "md"                    => ['required', 'between:0,9999999.99', new NumberFormatRule($this->getFormatPattern())],
            "pmd"                   => ['required', 'between:0,9999999.99', new NumberFormatRule($this->getFormatPattern())],
            "h_md"                  => [new RequiredIf($this->h_mdRadioOptions == 'applied'), 'between:0,9999999.99', new NumberFormatRule($this->getFormatPattern())],
            "h_pmd"                 => [new RequiredIf($this->h_pmdRadioOptions == 'applied'), 'between:0,9999999.99', new NumberFormatRule($this->getFormatPattern())],
            "referral_bonus"        => [new RequiredIf($this->referral_bonusRadioOptions == 'applied'), 'between:0,9999999.99', 'regex:/^[\d\.,]+$/'],
            "main_url"              => "nullable|url",
            "url_1"              => "nullable|url",
            "company_id"            => [new RequiredIf($this->sale_rights != 'full_disclosure'), 'array'],
            "sale_status"           => "required",
            "contact_notifications" => "required",
            "exposer_order"         => "nullable|numeric",
            // "banner"                   => "mimes:jpeg,jpg,png,gif",
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
     * Get the price format pattern based on the commission type
     *
     * @return string
     */
    private function getFormatPattern()
    {
        return $this->commission_type == 'with-ratio' ? '/^[0-9]+(\.[0-9]{1,2})?$/' : '/^\d{1,3}(,\d{3})*$/';
    }

    public function messages()
    {
        return [
            'company_id.required' => trans('product::validation.should-select-one'),
            'user_id.required'    => trans('product::validation.manager-required'),
        ];
    }
}
