<?php 

namespace LVR\Phone;

use Exception;
use Illuminate\Support\ServiceProvider as IlluminateProvider;
use LVR\Phone\Validator;

class ServiceProvider extends IlluminateProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->resolving('validator', function ($factory, $app) {
            
            $x = new Validator();

            $factory->extend('phone', function ($attribute, $value, $parameters, $validator) use ($x) {
                if (count($parameters) > 0) {
                    switch ($parameters[0]) {
                        case 'digits':
                            return $x->isDigits($value);
                        case 'e164':
                        case 'E164':
                            return $x->isE164($value);
                        case 'nanp':
                        case 'NANP':
                            return $x->isNANP($value);
                        default:
                            throw new Exception($parameters[0]." is not a supported phone validation type.", 1);
                    }
                } else {
                    return $x->isPhone($value);
                }
            }, "Not a valid phone number");
        });
    }
}
