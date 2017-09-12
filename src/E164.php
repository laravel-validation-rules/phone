<?php
namespace LVR\Phone;

use Illuminate\Contracts\Validation\Rule;

class E164 extends Phone
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->isE164($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute must be in E.164 phone format';
    }
}