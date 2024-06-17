<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class ValidDeathDate implements Rule
{
    private $birthDate;

    public function __construct($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function passes($attribute, $value)
    {
        $deathDate = Carbon::createFromFormat('d/m/Y', $value);
        $birthDate = Carbon::createFromFormat('d/m/Y', $this->birthDate);

        return $deathDate->gt($birthDate) && $deathDate->lte(Carbon::today());
    }

    public function message()
    {
        return 'Ngày mất phải sau ngày sinh và trước hơn ngày hôm nay.';
    }
}
