<?php

namespace Modules\Allowance\Http\Requests;

use App\Http\Requests\FormRequest;
use Modules\Allowance\Rules\NumberFormatRule;

class AllowanceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_month'                         => 'required|string',
            'member_id'                             => 'required|exists:users,id',
            'commission'                            => ['nullable', new NumberFormatRule],
            'referral_bonus'                        => ['nullable', new NumberFormatRule],
            'headquarters_representative_allowance' => ['required', new NumberFormatRule],
            'organization_division_allowance'       => ['required', new NumberFormatRule],
            'policy_allowance'                      => ['required', new NumberFormatRule],
            'other_allowances'                      => ['required', new NumberFormatRule],
            'income_tax'                            => ['required', new NumberFormatRule],
            'resident_tax'                          => ['required', new NumberFormatRule],
            'year_end_settlement'                   => ['required', new NumberFormatRule],
            'other_deductions_1'                    => ['required', new NumberFormatRule],
            'other_deductions_2'                    => ['required', new NumberFormatRule],
            'total_deduction'                       => ['required', new NumberFormatRule],
            'total_before_tax'                      => ['required', new NumberFormatRule],
            'deducted_amount_received'              => ['required', new NumberFormatRule],
        ];
    }

    public function messages()
    {
        return [
            'member_id.required' => 'Member field is required.',
            'member_id.exists'   => 'Member is not found.',
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
