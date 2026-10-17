<?php
namespace LVR\Phone;

class E164 extends Phone
{
    /**
     * Validation error message
     */
    protected string $message = ':attribute must be in E.164 phone format';

    /**
     * Checks the value against the E.164 format
     * @param  string  $value The phone number to check
     * @return bool
     */
    protected function passes(string $value): bool
    {
        return $this->isE164($value);
    }
}
