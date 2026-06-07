<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Csrf;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->layout = 'admin';
        $this->guardAdmin();
    }

    public function index(): void
    {
        $this->view('admin/settings', [
            'pageTitle' => 'Settings',
            'adminPage' => 'settings',
        ]);
    }

    public function update(): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/settings'), ['error' => 'Invalid form submission.']);
        }

        $envPath = ROOT_PATH . '/.env';

        if (!is_readable($envPath) || !is_writable($envPath)) {
            $this->redirect(url('/admin/settings'), ['error' => 'Cannot write to .env file. Please check file permissions.']);
        }

        // Fields allowed to be updated via this form
        $fields = [
            'RECAPTCHA_SITE_KEY',
            'RECAPTCHA_SECRET_KEY',
            'GOOGLE_MAPS_EMBED_URL',
        ];

        $lines   = file($envPath, FILE_IGNORE_NEW_LINES);
        $updated = [];

        foreach ($lines as $line) {
            $trimmed = trim($line);

            // Preserve blank lines and comments
            if ($trimmed === '' || $trimmed[0] === '#') {
                $updated[] = $line;
                continue;
            }

            $parts = explode('=', $trimmed, 2);
            $key   = trim($parts[0]);

            if (in_array($key, $fields, true) && isset($_POST[$key])) {
                $val     = str_replace(["\r", "\n"], '', $_POST[$key]);
                $updated[] = $key . '=' . $val;
            } else {
                $updated[] = $line;
            }
        }

        file_put_contents($envPath, implode("\n", $updated) . "\n");

        $this->redirect(url('/admin/settings'), ['success' => 'Settings saved successfully.']);
    }
}
