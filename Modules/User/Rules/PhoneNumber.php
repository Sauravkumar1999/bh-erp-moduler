<?php

namespace Modules\User\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    public function passes($attribute, $value)
    {
        // Remove non-digit characters from the value
        $cleanedValue = $value;

        // Check the length and prefix based on different cases
        if (preg_match('/^\d{10,11}$/', $cleanedValue)) {
            return (strlen($cleanedValue) === 10 || strlen($cleanedValue) === 11);
        }

        return false;
    }

    public function message()
    {
        return '유효하지 않은 전화 번호.';
    }
}
