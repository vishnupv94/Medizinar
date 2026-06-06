<?php

use App\Core\Database;
use App\Core\Env;
use App\Helpers\Csrf;
use App\Helpers\Flash;
use App\Helpers\Html;
use App\Helpers\Validator;

function env(string $key, mixed $default = null): mixed
{
    return Env::get($key, $default);
}

function db(): Database
{
    return Database::getInstance();
}

function h(string $string): string
{
    return Html::escape($string);
}

function url(string $path = ''): string
{
    $base = rtrim(SITE_URL, '/');
    return $base . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
    return url('assets/' . ltrim($path, '/'));
}

function csrf_token(): string
{
    return Csrf::token();
}

function csrf_field(): string
{
    return Csrf::field();
}

function csrf_verify(string $token): bool
{
    return Csrf::verify($token);
}

function flash(string $key): ?string
{
    return Flash::get($key);
}

function whatsapp_link(string $num, string $message = ''): string
{
    return Html::whatsappLink($num, $message);
}

function sanitize_input(string $value): string
{
    return Validator::sanitize($value);
}

function validate_phone(string $phone): bool
{
    return Validator::phone($phone);
}

function validate_email(string $email): bool
{
    return Validator::email($email);
}

function partial(string $name, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require APP_PATH . '/Views/partials/' . $name . '.php';
}
