<?php

namespace App\Core;

class Controller
{
    protected string $layout = 'main';

    protected function guardAdmin(): void
    {
        $timeout = (int) env('ADMIN_SESSION_LIFETIME', 3600);

        if (!isset($_SESSION['admin_id'])) {
            $this->redirect(url('/admin/login'));
        }

        if (isset($_SESSION['admin_last_activity']) && (time() - $_SESSION['admin_last_activity']) > $timeout) {
            unset($_SESSION['admin_id'], $_SESSION['admin_name'], $_SESSION['admin_email'], $_SESSION['admin_last_activity']);
            $this->redirect(url('/admin/login'), ['error' => 'Session expired. Please log in again.']);
        }

        $_SESSION['admin_last_activity'] = time();
    }

    protected function view(string $page, array $data = []): void
    {
        extract($data, EXTR_SKIP);

        ob_start();
        require \APP_PATH . '/Views/pages/' . $page . '.php';
        $content = ob_get_clean();

        require \APP_PATH . '/Views/layouts/' . $this->layout . '.php';
    }

    protected function redirect(string $url, array $flash = []): void
    {
        foreach ($flash as $key => $value) {
            \App\Helpers\Flash::set($key, $value);
        }
        header('Location: ' . $url);
        exit;
    }
}
