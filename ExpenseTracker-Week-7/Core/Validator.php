<?php

namespace Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function number($value, $min = 0)
    {
        return is_numeric($value) && $value >= $min;
    }

    public static function date($value)
    {
        return (bool)strtotime($value);
    }
}

// class Validator{

//     public static function string($value, $min = 1, $max = INF){
//         $value = trim($value);
//         return strlen($value) >= $min && strlen($value) <= $max;
//     }

//     public static function email($value){
//         return filter_var($value, FILTER_VALIDATE_EMAIL);
//     }
// }