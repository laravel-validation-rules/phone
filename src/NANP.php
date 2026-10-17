<?php
namespace LVR\Phone;

class NANP extends Phone
{
    /**
     * Validation error message
     */
    protected string $message = ':attribute must be in the NANP phone format';

    /**
     * Checks the value against the NANP format
     * @param  string  $value The phone number to check
     * @return bool
     */
    protected function passes(string $value): bool
    {
        return $this->isNANP($value);
    }
}
