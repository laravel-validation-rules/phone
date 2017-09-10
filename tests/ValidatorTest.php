<?php

namespace LVR\Phone\Tests;

use Exception;
use LVR\Phone\Validator as PhoneValidator;
use Validator;

class ValidatorTest extends TestCase
{
    public function testItCreatesAnInstanceOfPhoneValidator()
    {
        $obj = new PhoneValidator();
        $this->assertInstanceOf(PhoneValidator::class, $obj);
    }

    protected function validate($number, $rule = 'phone')
    {
        return !(Validator::make(['attr' => $number], ['attr' => $rule])->fails());
    }

    public function testUnsupportedValidationTypes()
    {
        $this->setExpectedException(Exception::class);
        $this->validate('+15556660000', 'phone:unsupportedtype');
    }

    public function testValidatorPhone()
    {
        $this->assertEquals(true, $this->validate('+15556667777', 'phone'));
        $this->assertEquals(true, $this->validate('(555) 666-7777', 'phone'));
        $this->assertEquals(true, $this->validate('5556667777', 'phone'));
    }

    public function testValidatorWithEmpty()
    {
        $this->assertEquals(true, $this->validate('', 'phone'));
        $this->assertEquals(true, $this->validate(null, 'phone'));
        $this->assertEquals(true, $this->validate([], 'phone'));
        $this->assertEquals(true, $this->validate(false, 'phone'));
    }

    public function testValidatorPhoneDigits()
    {
        $this->assertEquals(false, $this->validate('+15556667777', 'phone:digits'));
        $this->assertEquals(false, $this->validate('(555) 666-7777', 'phone:digits'));
        $this->assertEquals(true, $this->validate('5556667777', 'phone:digits'));
        $this->assertEquals(true, $this->validate('15556667777', 'phone:digits'));
    }

    public function testValidatorPhoneE164()
    {
        $this->assertEquals(true, $this->validate('+15556660000', 'phone:E164'));
        $this->assertEquals(true, $this->validate('+556660000', 'phone:E164'));
        $this->assertEquals(true, $this->validate('+155555556660000', 'phone:E164'));
        $this->assertEquals(false, $this->validate('+1555 ex 1234', 'phone:E164'));
        $this->assertEquals(false, $this->validate('+155566677775556667777', 'phone:E164'));
        $this->assertEquals(false, $this->validate('+1555', 'phone:E164'));
        $this->assertEquals(false, $this->validate('5556667777', 'phone:E164'));
        $this->assertEquals(false, $this->validate('+1 (555) 666-7777', 'phone:E164'));
        $this->assertEquals(false, $this->validate('+1(555)666-7777', 'phone:E164'));
        $this->assertEquals(false, $this->validate('(555) 666-7777', 'phone:E164'));
        $this->assertEquals(false, $this->validate('(abc) def-ghij', 'phone:E164'));
        $this->assertEquals(false, $this->validate('+zabcdefghij', 'phone:E164'));
    }

    public function testValidatorPhoneNANP()
    {
        $this->assertEquals(true, $this->validate('+1 (555) 666-7777', 'phone:NANP'));
        $this->assertEquals(true, $this->validate('(555) 666-7777', 'phone:NANP'));
        $this->assertEquals(true, $this->validate('(555) 555-5555', 'phone:NANP'));
        $this->assertEquals(true, $this->validate('1-555-555-5555', 'phone:NANP'));
        $this->assertEquals(true, $this->validate('555-555-5555', 'phone:NANP'));
        $this->assertEquals(true, $this->validate('1 555 555-5555', 'phone:NANP'));
        $this->assertEquals(true, $this->validate('+1 (555) 555-5555', 'phone:NANP'));
        $this->assertEquals(true, $this->validate('1 (555) 555-5555', 'phone:NANP'));
        $this->assertEquals(true, $this->validate('+1(555) 666-7777', 'phone:NANP'));
        $this->assertEquals(true, $this->validate('+1(555)666-7777', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('1 (555)   555-5555', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('1 (555))))) 555-5555', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('+(555)555-5555', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('((555)555-5555', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('5555555555', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('+15556660000', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('+1555 ex 1234', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('+155566677775556667777', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('+1555', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('5556667777', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('(abc) def-ghij', 'phone:NANP'));
        $this->assertEquals(false, $this->validate('+zabcdefghij', 'phone:NANP'));
    }

    public function testValidatorErrorMessage()
    {
        $validator = Validator::make(['attr' => '+1555 ex 1234'], ['attr' => 'phone:E164']);
        $this->assertEquals("Not a valid phone number", $validator->errors()->first());
    }
}
