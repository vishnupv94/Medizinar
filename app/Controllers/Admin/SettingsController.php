<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Csrf;
use App\Models\Admin;
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

    public function changePassword(): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/settings'), ['error' => 'Invalid form submission.']);
        }

        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword     = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Basic validation
        if ($currentPassword === '' || $newPassword === '' || $confirmPassword === '') {
            $this->redirect(url('/admin/settings'), ['error' => 'All password fields are required.']);
        }

        if (strlen($newPassword) < 8) {
            $this->redirect(url('/admin/settings'), ['error' => 'New password must be at least 8 characters.']);
        }

        if ($newPassword !== $confirmPassword) {
            $this->redirect(url('/admin/settings'), ['error' => 'New password and confirmation do not match.']);
        }

        // Verify current password
        $adminId = $_SESSION['admin_id'] ?? 0;
        $admin   = Admin::findById((int) $adminId);

        if (!$admin || !Admin::verifyPassword($currentPassword, $admin->password_hash)) {
            $this->redirect(url('/admin/settings'), ['error' => 'Current password is incorrect.']);
        }

        Admin::updatePassword((int) $adminId, $newPassword);

        $this->redirect(url('/admin/settings'), ['success' => 'Password changed successfully.']);
    }
}
