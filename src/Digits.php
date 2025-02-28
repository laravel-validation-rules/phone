<?php
namespace LVR\Phone;

use Closure;

class Digits extends Phone
{
    /**
     * Validation error message
     */
    protected string $message = ':attribute must be in digits only phone format';

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
        if (! $this->isDigits($value)) {
            $fail($this->message);
        }
    }
}
