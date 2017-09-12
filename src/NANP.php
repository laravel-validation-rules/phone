<?php
namespace LVR\Phone;

use Illuminate\Contracts\Validation\Rule;

class NANP extends Phone
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *s
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->isNANP($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute must be in the NANP phone format';
    }
}