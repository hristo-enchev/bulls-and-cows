<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NonRepetable implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $result = array_count_values(str_split($value));

        arsort($result);

        foreach ($result as $value) {
            if ($value > 1) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Duplicate numbers are not allowed!';
    }
}
