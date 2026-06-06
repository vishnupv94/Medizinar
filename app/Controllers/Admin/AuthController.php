<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Csrf;
use App\Models\Admin;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->layout = 'auth';
    }

    public function loginForm(): void
    {
        if (isset($_SESSION['admin_id'])) {
            $this->redirect(url('/admin/dashboard'));
        }

        $this->view('admin/login', [
            'pageTitle' => 'Admin Login',
        ]);
    }

    public function login(): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/login'), ['error' => 'Invalid form submission.']);
        }

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            $this->redirect(url('/admin/login'), ['error' => 'Email and password are required.']);
        }

        $admin = Admin::findByEmail($email);

        if (!$admin || !Admin::verifyPassword($password, $admin->password_hash)) {
            $this->redirect(url('/admin/login'), ['error' => 'Invalid email or password.']);
        }

        session_regenerate_id(true);

        $_SESSION['admin_id']            = $admin->id;
        $_SESSION['admin_name']          = $admin->name;
        $_SESSION['admin_email']         = $admin->email;
        $_SESSION['admin_last_activity'] = time();

        $this->redirect(url('/admin/dashboard'));
    }

    public function logout(): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/dashboard'));
        }

        unset(
            $_SESSION['admin_id'],
            $_SESSION['admin_name'],
            $_SESSION['admin_email'],
            $_SESSION['admin_last_activity']
        );

        session_regenerate_id(true);

        $this->redirect(url('/admin/login'), ['success' => 'Logged out successfully.']);
    }
}
