<?php

namespace App\Helpers;

class Html
{
    public static function escape(string $string): string
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    public static function whatsappLink(string $num, string $message = ''): string
    {
        $msg = $message ? '?text=' . urlencode($message) : '';
        return 'https://wa.me/' . preg_replace('/\D/', '', $num) . $msg;
    }
}
