# Validate phone numbers with Laravel 5
[![Latest Version](https://img.shields.io/github/release/laravel-valiation-rules/us-phone.svg?style=flat-square)](https://github.com/laravel-valiation-rules/us-phone/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/laravel-valiation-rules/us-phone.svg?branch=master)](https://travis-ci.org/laravel-valiation-rules/us-phone)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/laravel-valiation-rules/us-phone/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/laravel-valiation-rules/us-phone/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/laravel-valiation-rules/us-phone/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/laravel-valiation-rules/us-phone/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-valiation-rules/us-phone.svg?style=flat-square)](https://packagist.org/packages/laravel-valiation-rules/us-phone)

This package only checks phone number formatting and not actual number validity.

## Installation

Install via [composer](https://getcomposer.org/) - In the terminal:
```bash
composer require laravel-valiation-rules/us-phone
```

Now add the following to the `providers` array in your `config/app.php`
```php
LVR\Phone\ServiceProvider::class
```

## Usage

```php
// Test any phone number
Validator::make(['test' => '15556667777'], ['test' => 'phone']); //true
Validator::make(['test' => '+15556667777'], ['test' => 'phone']); //true
Validator::make(['test' => '+1 (555) 666-7777'], ['test' => 'phone']); //true

// Test for E164
Validator::make(['test' => '+15556667777'], ['test' => 'phone:E164']); //true

// Test for NANP (North American Numbering Plan)
Validator::make(['test' => '+1 (555) 666-7777'], ['test' => 'phone:NANP']); //true

// Test for digits only
Validator::make(['test' => '15556667777'], ['test' => 'phone:digits']); //true
```
