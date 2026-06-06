<?php

namespace App\Helpers;

class Flash
{
    public static function set(string $key, string $value): void
    {
        $_SESSION['flash_' . $key] = $value;
    }

    public static function get(string $key): ?string
    {
        $fkey = 'flash_' . $key;
        if (isset($_SESSION[$fkey])) {
            $value = $_SESSION[$fkey];
            unset($_SESSION[$fkey]);
            return $value;
        }
        return null;
    }
}
