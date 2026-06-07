<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Csrf;
use App\Models\SiteSetting;

class SettingsController extends Controller
{
    private const FIELDS = [
        'RECAPTCHA_SITE_KEY',
        'RECAPTCHA_SECRET_KEY',
        'GOOGLE_MAPS_EMBED_URL',
    ];

    public function __construct()
    {
        $this->layout = 'admin';
        $this->guardAdmin();
    }

    public function index(): void
    {
        // Load current values from DB (fallback to constants from .env via app.php)
        $settings = SiteSetting::all();

        $this->view('admin/settings', [
            'pageTitle' => 'Settings',
            'adminPage' => 'settings',
            'settings'  => $settings,
        ]);
    }

    public function update(): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/settings'), ['error' => 'Invalid form submission.']);
        }

        $data = [];
        foreach (self::FIELDS as $field) {
            if (isset($_POST[$field])) {
                // Sanitise: strip bare CR/LF characters (textarea may inject them)
                $data[$field] = trim(str_replace(["\r\n", "\r"], "\n", $_POST[$field]));
            }
        }

        SiteSetting::setMany($data);

        $this->redirect(url('/admin/settings'), ['success' => 'Settings saved successfully.']);
    }
}
