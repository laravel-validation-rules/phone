# Phone

Validates phone number format.

<p >
  <a href="https://travis-ci.org/laravel-validation-rules/us-phone">
    <img src="https://img.shields.io/travis/laravel-validation-rules/us-phone.svg?style=flat-square">
  </a>
  <a href="https://scrutinizer-ci.com/g/laravel-validation-rules/us-phone/code-structure/master/code-coverage">
    <img src="https://img.shields.io/scrutinizer/coverage/g/laravel-validation-rules/us-phone.svg?style=flat-square">
  </a>
  <a href="https://scrutinizer-ci.com/g/laravel-validation-rules/us-phone">
    <img src="https://img.shields.io/scrutinizer/g/laravel-validation-rules/us-phone.svg?style=flat-square">
  </a>
  <a href="https://github.com/laravel-validation-rules/us-phone/blob/master/LICENSE">
    <img src="https://img.shields.io/github/license/laravel-validation-rules/us-phone.svg?style=flat-square">
  </a>
  <a href="https://twitter.com/tylercd100">
    <img src="http://img.shields.io/badge/author-@tylercd100-blue.svg?style=flat-square">
  </a>
</p>

## Installation

```bash
composer require laravel-validation-rules/us-phone
```

## Usage

```php
use LVR\Phone\Digits;
use LVR\Phone\E164;
use LVR\Phone\NANP;
use LVR\Phone\NTNP;

# Test for E.164
$request->validate(['test' => '+12025550147'], ['test' => new E164]); # Pass!

# Test for USA, Canada, Mexico
# NANP (North American Numbering Plan)
$request->validate(['test' => '+1 (202) 555-0147'], ['test' => new NANP); # Pass!

# Test for United Kingdom
# NTNP (National Telephone Numbering Plan)
$request->validate(['test' => '+44 (020) 7946 0859'], ['test' => new NANP); # Pass!

# Test for digits only
$request->validate(['test' => '12025550147'], ['test' => new Digits]); # Pass!
```

*Used fake phone numbers from [fakenumber.org](https://fakenumber.org/)*