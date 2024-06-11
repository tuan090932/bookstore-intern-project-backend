<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class ValidBirthDate implements Rule
{
    public function passes($attribute, $value)
    {
        $birthDate = Carbon::createFromFormat('d/m/Y', $value);
        return $birthDate->lte(Carbon::today());
    }

    public function message()
    {
        return 'Ngày sinh phải nhỏ hơn ngày hôm nay.';
    }
}
