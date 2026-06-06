<?php

namespace App\Helpers;

class Validator
{
    public static function phone(string $phone): bool
    {
        $clean = preg_replace('/[\s\-\+\(\)]/', '', $phone);
        return preg_match('/^[6-9]\d{9}$/', $clean) === 1
            || preg_match('/^(\+91|91)[6-9]\d{9}$/', $clean) === 1;
    }

    public static function email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function sanitize(string $value): string
    {
        return trim(strip_tags($value));
    }
}
