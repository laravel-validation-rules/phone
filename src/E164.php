<?php
namespace LVR\Phone;

use Illuminate\Contracts\Validation\Rule;

/**
 * E.164 - The International Public Telecommunication Numbering Plan
 * https://en.wikipedia.org/wiki/E.164
 * 
 * Plan-conforming numbers are limited to a maximum of 15 digits, excluding the international call prefix.
 * The presentation of a number is usually prefixed with the plus sign (+), indicating that the number 
 * includes the country calling code.
 *
 * Examples
 * +15556660000
 * +447911123456
 */
class E164 extends Base
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

    /**
     * Format example +15555555555
     * @param  string  $value The phone number to check
     * @return boolean        is it correct format?
     */
    protected function isE164($value)
    {
        $conditions = [];
        $conditions[] = strpos($value, "+") === 0;
        $conditions[] = strlen($value) >= 9;
        $conditions[] = strlen($value) <= 16;
        $conditions[] = preg_match("/[^\d+]/i", $value) === 0;
        return (bool) array_product($conditions);
    }
}