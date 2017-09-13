<?php
namespace LVR\Phone;

use Illuminate\Contracts\Validation\Rule;

class Digits extends Base
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
        return $this->isDigits($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute must be in digits only phone format';
    }

    /**
     * Format example 5555555555, 15555555555
     * @param  [type]  $value [description]
     * @return boolean        [description]
     */
    protected function isDigits($value)
    {
        $conditions = [];
        $conditions[] = strlen($value) >= 10;
        $conditions[] = strlen($value) <= 16;
        $conditions[] = preg_match("/[^\d]/i", $value) === 0;
        return (bool) array_product($conditions);
    }
}
