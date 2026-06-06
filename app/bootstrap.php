<?php

define('APP_PATH', __DIR__);
define('ROOT_PATH', dirname(__DIR__));

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $file     = APP_PATH . '/' . str_replace('\\', '/', $relative) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

App\Core\Env::load(ROOT_PATH . '/.env');

require APP_PATH . '/Helpers/functions.php';
require APP_PATH . '/Config/app.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

App\Helpers\Csrf::token();
