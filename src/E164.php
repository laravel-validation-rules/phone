<?php
namespace LVR\Phone;

use Closure;

class E164 extends Phone
{
    /**
     * Validation error message
     */
    protected string $message = ':attribute must be in E.164 phone format';

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
        if (! $this->isE164($value)) {
            $fail($this->message);
        }
    }
}
