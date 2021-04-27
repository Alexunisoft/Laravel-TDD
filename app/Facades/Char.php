<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Char
 * @method static String getCamelCase(String $string).
 * @package App\Facades
 */
class Char extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "App\BackingClasses\Char";
    }
}
