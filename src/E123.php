<?php

namespace LVR\Phone;

use Closure;

class E123 extends Phone
{
    /**
     * Validation error message
     */
    protected string $message = ':attribute must be in E.123 phone format';

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! $this->isE123($value)) {
            $fail($this->message);
        }
    }
}
