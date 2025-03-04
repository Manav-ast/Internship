<?php

namespace Core;

class Validator
{
    public static $errors = [];

    // Validate that a value is not empty.
    public static function required($value, $field = '')
    {
        if (empty(trim($value))) {
            self::$errors[$field] = ucfirst($field) . " is required";
            return false;
        }
        return true;
    }

    // Validate that a string length is within the given range.
    public static function string($value, $min = 1, $max = 255, $field = '')
    {
        $length = strlen(trim($value));
        if (!($length >= $min && $length <= $max)) {
            self::$errors[$field] = ucfirst($field) . " must be between {$min} and {$max} characters";
            return false;
        }
        return true;
    }

    // Validate that a value is a valid positive number.       
    public static function number($value, $field = '')
    {
        if (!(filter_var($value, FILTER_VALIDATE_FLOAT) && $value > 0)) {
            self::$errors[$field] = ucfirst($field) . " must be a positive number";
            return false;
        }
        return true;
    }

    // Validate expense data
    public static function validateExpense($data)
    {
        self::$errors = [];

        self::required($data['expense_name'], 'expense_name');
        self::string($data['expense_name'], 1, 255, 'expense_name');
        
        self::required($data['amount'], 'amount');
        self::number($data['amount'], 'amount');
        
        self::required($data['date'], 'date');
        if (!strtotime($data['date'])) {
            self::$errors['date'] = "Invalid date format";
        }
        
        self::required($data['group_id'], 'group_id');
        if (!filter_var($data['group_id'], FILTER_VALIDATE_INT)) {
            self::$errors['group_id'] = "Invalid group selected";
        }

        return empty(self::$errors);
    }

    // Validate group data
    public static function validateGroup($data)
    {
        self::$errors = [];

        self::required($data['name'], 'name');
        self::string($data['name'], 1, 255, 'name');

        return empty(self::$errors);
    }

    // Get validation errors
    public static function getErrors()
    {
        return self::$errors;
    }
}
