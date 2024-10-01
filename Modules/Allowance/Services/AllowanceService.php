<?php

namespace Modules\Allowance\Services;

use Modules\Allowance\Entities\Allowance;

class AllowanceService
{

    public function save(array $data, Allowance $allowance = null): Allowance
    {
        if (!$allowance) {
            $allowance = new Allowance();
        }

        $allowance->payment_month = $data['payment_month'];
        $allowance->member_id = str_replace(',', '', $data['member_id']);
        $allowance->commission = str_replace(',', '', $data['commission']);
        $allowance->referral_bonus = str_replace(',', '', $data['referral_bonus']);
        $allowance->headquarters_representative_allowance = str_replace(',', '', $data['headquarters_representative_allowance'],);
        $allowance->organization_division_allowance = str_replace(',', '', $data['organization_division_allowance'],);
        $allowance->policy_allowance = str_replace(',', '', $data['policy_allowance'],);
        $allowance->other_allowances = str_replace(',', '', $data['other_allowances'],);
        $allowance->income_tax = str_replace(',', '', $data['income_tax'],);
        $allowance->resident_tax = str_replace(',', '', $data['resident_tax'],);
        $allowance->year_end_settlement = str_replace(',', '', $data['year_end_settlement'],);
        $allowance->other_deductions_1 = str_replace(',', '', $data['other_deductions_1'],);
        $allowance->other_deductions_2 = str_replace(',', '', $data['other_deductions_2'],);
        $allowance->total_deduction = str_replace(',', '', $data['total_deduction'],);
        $allowance->total_before_tax = str_replace(',', '', $data['total_before_tax'],);
        $allowance->deducted_amount_received = str_replace(',', '', $data['deducted_amount_received'],);
        $allowance->save();
        return $allowance;
    }

}
