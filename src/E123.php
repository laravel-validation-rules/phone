<?php

namespace LVR\Phone;

class E123 extends Phone
{
    /**
     * Validation error message
     */
    protected string $message = ':attribute must be in E.123 phone format';

    /**
     * Checks the value against the E.123 format
     * @param  string  $value The phone number to check
     * @return bool
     */
    protected function passes(string $value): bool
    {
        return $this->isE123($value);
    }
}
