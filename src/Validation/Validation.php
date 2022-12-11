<?php

namespace Riyu\Validation;

class Validation
{
    /**
     * Make validation
     * 
     * @param array $data
     * @param array $rules
     * @return array
     */
    public static function make($data, $rules)
    {
        $errors = [];
        if (!is_array($data) || !is_array($rules)) {
            return false;
        }
        foreach ($rules as $key => $rule) {
            $rules = explode('|', $rule);
            foreach ($rules as $rule) {
                $rule = explode(':', $rule);
                $ruleName = $rule[0];
                $ruleValue = $rule[1] ?? null;
                $error = self::$ruleName($data[$key], $ruleValue);
                if ($error) {
                    $errors[$key][] = $error;
                }
            }
        }
        return $errors;
    }

    /**
     * Custom error message
     * 
     * @param array $errors
     * @param array $messages
     * @return array
     */
    public static function customMessage($errors, $messages)
    {
        foreach ($errors as $key => $error) {
            foreach ($error as $index => $message) {
                if (array_key_exists($key, $messages)) {
                    $errors[$key][$index] = $messages[$key];
                }
            }
        }
        return $errors;
    }

    /**
     * Check if value is required
     * 
     * @param mixed $value
     * @param string $field
     * @return string
     */
    public static function required($value, $field = null)
    {
        if (empty($value)) {
            return 'This field is required';
        }
    }

    /**
     * Check if value min length
     * 
     * @param mixed $value
     * @param string $field
     * @return string
     */
    public static function min($value, $min)
    {
        if (strlen($value) < $min) {
            return "This field must be at least $min characters";
        }
    }

    /**
     * Check if value max length
     * 
     * @param mixed $value
     * @param string $field
     * @return string
     */
    public static function max($value, $max)
    {
        if (strlen($value) > $max) {
            return "This field must be at most $max characters";
        }
    }

    /**
     * Check if value is email
     * 
     * @param mixed $value
     * @param string $field
     * @return string
     */
    public static function email($value, $field = null)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return 'This field must be a valid email';
        }
    }

    /**
     * Check if value is confirmed
     * 
     * @param mixed $value
     * @param string $field
     * @return string
     */
    public static function confirmed($value, $field)
    {
        if ($value != $_POST[$field . '_confirmation']) {
            return 'This field must be confirmed';
        }
    }

    public static function __callStatic($name, $arguments)
    {
        if (method_exists(self::class, $name)) {
            return self::$name(...$arguments);
        }
    }

    public function __call($name, $arguments)
    {
        if (method_exists(self::class, $name)) {
            return self::$name(...$arguments);
        }
    }
}
