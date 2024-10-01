<?php

namespace Modules\Allowance\Imports;

use Modules\Allowance\Entities\Allowance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Modules\Allowance\Rules\NumberFormatRule;

class AllowancesImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * @param array $row
     *
     * @return Allowance|null
     */
    public function model(array $row)
    {
        $allowance = new Allowance();
        $allowance->payment_month                           = $row['payment_month'];
        $allowance->member_id                               = $row['member_id'];
        $allowance->headquarters_representative_allowance   = $row['headquarters_representative_allowance'];
        $allowance->organization_division_allowance         = $row['organization_division_allowance'];
        $allowance->policy_allowance                        = $row['policy_allowance'];
        $allowance->other_allowances                        = $row['other_allowances'];
        $allowance->income_tax                              = $row['income_tax'];
        $allowance->resident_tax                            = $row['resident_tax'];
        $allowance->year_end_settlement                     = $row['year_end_settlement'];
        $allowance->other_deductions_1                      = $row['other_deductions_1'];
        $allowance->other_deductions_2                      = $row['other_deductions_2'];
        $allowance->total_deduction                         = $row['total_deduction'];
        $allowance->total_before_tax                        = $row['total_before_tax'];
        $allowance->deducted_amount_received                = $row['deducted_amount_received'];
        return $allowance;
    }

    public function rules(): array
    {
        return [
            'payment_month' => 'required|string',
            'member_id' => 'required|exists:users,id',
            'headquarters_representative_allowance' => ['required', new NumberFormatRule],
            'organization_division_allowance' => ['required', new NumberFormatRule],
            'policy_allowance' => ['required', new NumberFormatRule],
            'other_allowances' => ['required', new NumberFormatRule],
            'income_tax' => ['required', new NumberFormatRule],
            'resident_tax' => ['required', new NumberFormatRule],
            'year_end_settlement' => ['required', new NumberFormatRule],
            'other_deductions_1' => ['required', new NumberFormatRule],
            'other_deductions_2' => ['required', new NumberFormatRule],
            'total_deduction' => ['required', new NumberFormatRule],
            'total_before_tax' => ['required', new NumberFormatRule],
            'deducted_amount_received' => ['required', new NumberFormatRule],
            'commission' => ['nullable', new NumberFormatRule],
            'referral_bonus' => ['nullable', new NumberFormatRule],
        ];
    }


}
