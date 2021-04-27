<?php


namespace App\BackingClasses;


use Illuminate\Support\Str;

class Char
{
    public function koko()
    {
        return "Welcome to KOKO";
    }

    public function getCamelCase(string $string)
    {
        return Str::camel($string);
    }
}
