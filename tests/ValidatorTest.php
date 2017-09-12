<?php

namespace LVR\Phone\Tests;

use Exception;
use LVR\Phone\Digits;
use LVR\Phone\E164;
use LVR\Phone\NANP;
use LVR\Phone\Phone;
use Validator;

class ValidatorTest extends TestCase
{
    protected function validate($number, Phone $rule)
    {
        return !(Validator::make(['attr' => $number], ['attr' => $rule])->fails());
    }

    public function testValidatorPhone()
    {
        $this->assertEquals(true, $this->validate('+15556667777', new Phone));
        $this->assertEquals(true, $this->validate('(555) 666-7777', new Phone));
        $this->assertEquals(true, $this->validate('5556667777', new Phone));
    }

    public function testValidatorPhoneDigits()
    {
        $this->assertEquals(false, $this->validate('+15556667777', new Digits));
        $this->assertEquals(false, $this->validate('(555) 666-7777', new Digits));
        $this->assertEquals(true, $this->validate('5556667777', new Digits));
        $this->assertEquals(true, $this->validate('15556667777', new Digits));
    }

    public function testValidatorPhoneE164()
    {
        $this->assertEquals(true, $this->validate('+15556660000', new E164));
        $this->assertEquals(true, $this->validate('+556660000', new E164));
        $this->assertEquals(true, $this->validate('+155555556660000', new E164));
        $this->assertEquals(false, $this->validate('+1555 ex 1234', new E164));
        $this->assertEquals(false, $this->validate('+155566677775556667777', new E164));
        $this->assertEquals(false, $this->validate('+1555', new E164));
        $this->assertEquals(false, $this->validate('5556667777', new E164));
        $this->assertEquals(false, $this->validate('+1 (555) 666-7777', new E164));
        $this->assertEquals(false, $this->validate('+1(555)666-7777', new E164));
        $this->assertEquals(false, $this->validate('(555) 666-7777', new E164));
        $this->assertEquals(false, $this->validate('(abc) def-ghij', new E164));
        $this->assertEquals(false, $this->validate('+zabcdefghij', new E164));
    }

    public function testValidatorPhoneNANP()
    {
        $this->assertEquals(true, $this->validate('+1 (555) 666-7777', new NANP));
        $this->assertEquals(true, $this->validate('(555) 666-7777', new NANP));
        $this->assertEquals(true, $this->validate('(555) 555-5555', new NANP));
        $this->assertEquals(true, $this->validate('1-555-555-5555', new NANP));
        $this->assertEquals(true, $this->validate('555-555-5555', new NANP));
        $this->assertEquals(true, $this->validate('1 555 555-5555', new NANP));
        $this->assertEquals(true, $this->validate('+1 (555) 555-5555', new NANP));
        $this->assertEquals(true, $this->validate('1 (555) 555-5555', new NANP));
        $this->assertEquals(true, $this->validate('+1(555) 666-7777', new NANP));
        $this->assertEquals(true, $this->validate('+1(555)666-7777', new NANP));
        $this->assertEquals(false, $this->validate('1 (555)   555-5555', new NANP));
        $this->assertEquals(false, $this->validate('1 (555))))) 555-5555', new NANP));
        $this->assertEquals(false, $this->validate('+(555)555-5555', new NANP));
        $this->assertEquals(false, $this->validate('((555)555-5555', new NANP));
        $this->assertEquals(false, $this->validate('5555555555', new NANP));
        $this->assertEquals(false, $this->validate('+15556660000', new NANP));
        $this->assertEquals(false, $this->validate('+1555 ex 1234', new NANP));
        $this->assertEquals(false, $this->validate('+155566677775556667777', new NANP));
        $this->assertEquals(false, $this->validate('+1555', new NANP));
        $this->assertEquals(false, $this->validate('5556667777', new NANP));
        $this->assertEquals(false, $this->validate('(abc) def-ghij', new NANP));
        $this->assertEquals(false, $this->validate('+zabcdefghij', new NANP));
    }

    public function testValidatorErrorMessage()
    {
        $validator = Validator::make(['attr' => '+1555 ex 1234'], ['attr' => new Phone]);
        $this->assertEquals("Incorrect phone format for attr.", $validator->errors()->first());

        $validator = Validator::make(['attr' => '+1555 ex 1234'], ['attr' => new E164]);
        $this->assertEquals("attr must be in E.164 phone format", $validator->errors()->first());

        $validator = Validator::make(['attr' => '+1555 ex 1234'], ['attr' => new NANP]);
        $this->assertEquals("attr must be in the NANP phone format", $validator->errors()->first());

        $validator = Validator::make(['attr' => '+1555 ex 1234'], ['attr' => new Digits]);
        $this->assertEquals("attr must be in digits only phone format", $validator->errors()->first());
    }
}
