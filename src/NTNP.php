<?php
namespace LVR\Phone;

use Illuminate\Contracts\Validation\Rule;

/**
 * National Telephone Numbering Plan
 * Used by the UK
 */
class NTNP extends Base
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
        return $this->isNTNP($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute must be in the NTNP phone format';
    }

    /**
     * 
     * Format Examples:
     * (020) xxxx xxxx 	London
     * (024) 7xxx xxxx	Coventry
     * (029) xxxx xxxx	Cardiff
     * (0113) xxx xxxx	Leeds
     * (0114) xxx xxxx	Sheffield
     * (0121) xxx xxxx	Birmingham
     * (0117) xxx xxxx	Bristol
     * (0131) xxx xxxx	Edinburgh
     * (0141) xxx xxxx	Glasgow
     * (0161) xxx xxxx	Manchester
     * (01223)  xxxxxx	Cambridge
     * (01382)  xxxxxx	Dundee
     * (01386)  xxxxxx	Evesham
     * (01935)  xxxxxx	Yeovil
     * (01865)  xxxxxx	Oxford
     * (01792)  xxxxxx	Swansea
     * (01204)  xxxxx	Bolton
     * (0153 96) xxxxx	Sedbergh
     * (0169 77) xxxx	Brampton
     */
    protected function isNTNP($value)
    {
        $conditions = [];
        $conditions[] = preg_match("/^(\+44\s)?\(?0[\d\s]{2,6}\)?\s\d{3,6}(\s\d{4})?$/i", $value) > 0;
        return (bool) array_product($conditions);
    }
}
