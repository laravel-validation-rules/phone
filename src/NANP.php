<?php
namespace LVR\Phone;

use Closure;

class NANP extends Phone
{
    /**
     * Validation error message
     */
    protected string $message = ':attribute must be in the NANP phone format';

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
        if (! $this->isNANP($value)) {
            $fail($this->message);
        }
    }
}
