<?php

namespace App\Helpers;

use App\Models\SiteSetting;

class Recaptcha
{
    private const VERIFY_URL = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Return the active site key (DB value takes priority over .env constant).
     */
    public static function siteKey(): string
    {
        try {
            $dbKey = SiteSetting::get('RECAPTCHA_SITE_KEY', '');
            return $dbKey !== '' ? $dbKey : (defined('RECAPTCHA_SITE_KEY') ? RECAPTCHA_SITE_KEY : '');
        } catch (\Throwable $e) {
            return defined('RECAPTCHA_SITE_KEY') ? RECAPTCHA_SITE_KEY : '';
        }
    }

    /**
     * Verify the reCAPTCHA token sent with the form.
     * Returns true if reCAPTCHA is not configured (no secret key),
     * so the forms still work during development.
     */
    public static function verify(string $token): bool
    {
        try {
            $dbSecret = SiteSetting::get('RECAPTCHA_SECRET_KEY', '');
            $secret   = $dbSecret !== '' ? $dbSecret : (defined('RECAPTCHA_SECRET_KEY') ? RECAPTCHA_SECRET_KEY : '');
        } catch (\Throwable $e) {
            $secret = defined('RECAPTCHA_SECRET_KEY') ? RECAPTCHA_SECRET_KEY : '';
        }

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

        if (!isset($json['success']) || $json['success'] !== true) {
            return false;
        }

        // reCAPTCHA v3 returns a score (0.0–1.0); v2 does not include this field.
        // Accept if score field is absent (v2) or >= 0.5 (v3).
        if (isset($json['score']) && $json['score'] < 0.5) {
            return false;
        }

        return true;
    }

    /**
     * Return true only when a site key is actually set.
     */
    public static function isEnabled(): bool
    {
        return self::siteKey() !== '';
    }
}
