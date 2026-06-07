<?php

namespace App\Helpers;

class Recaptcha
{
    private const VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Verify the reCAPTCHA token sent with the form.
     * Returns true if reCAPTCHA is not configured (no secret key),
     * so the forms still work during development.
     */
    public static function verify(string $token): bool
    {
        $secret = defined('RECAPTCHA_SECRET_KEY') ? RECAPTCHA_SECRET_KEY : '';

        if ($secret === '') {
            // reCAPTCHA not configured – skip verification
            return true;
        }

        if ($token === '') {
            return false;
        }

        $data = http_build_query([
            'secret'   => $secret,
            'response' => $token,
            'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
        ]);

        $context = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => $data,
                'timeout' => 10,
            ],
        ]);

        $result = @file_get_contents(self::VERIFY_URL, false, $context);

        if ($result === false) {
            // Network failure – fail open to avoid blocking legitimate users
            return true;
        }

        $json = json_decode($result, true);

        return isset($json['success']) && $json['success'] === true;
    }

    /**
     * Return true only when a site key is actually set.
     */
    public static function isEnabled(): bool
    {
        return defined('RECAPTCHA_SITE_KEY') && RECAPTCHA_SITE_KEY !== '';
    }
}
