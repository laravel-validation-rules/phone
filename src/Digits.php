<?php
namespace LVR\Phone;

class Digits extends Phone
{
    /**
     * Validation error message
     */
    protected string $message = ':attribute must be in digits only phone format';

    /**
     * Checks the value against the Digits format
     * @param  string  $value The phone number to check
     * @return bool
     */
    protected function passes(string $value): bool
    {
        return $this->isDigits($value);
    }
}
