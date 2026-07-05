<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\TeamMember;

class TeamController extends Controller
{
    private const UPLOAD_DIR = 'uploads/team/';
    private const PER_PAGE   = 20;

    public function index(): void
    {
        $q      = trim($_GET['q'] ?? '');
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $offset = ($page - 1) * self::PER_PAGE;

        $items = TeamMember::getFiltered($q, self::PER_PAGE, $offset);
        $total = TeamMember::countFiltered($q);
        $pages = max(1, (int) ceil($total / self::PER_PAGE));

        $this->view('admin/team-list', compact('items', 'q', 'page', 'pages', 'total') + ['pageTitle' => 'Team Members']);
    }

    public function create(): void
    {
        $this->view('admin/team-form', ['member' => null, 'errors' => [], 'old' => [], 'pageTitle' => 'New Team Member']);
    }

    public function store(): void
    {
        $data   = $this->sanitize($_POST);
        $errors = $this->validate($data);

        $photoResult = $this->handleUpload();
        if (isset($photoResult['error'])) {
            $errors['photo'] = $photoResult['error'];
        } elseif ($photoResult['path']) {
            $data['photo'] = $photoResult['path'];
        }

        if ($errors) {
            $this->view('admin/team-form', ['member' => null, 'errors' => $errors, 'old' => $data, 'pageTitle' => 'New Team Member']);
            return;
        }

        TeamMember::create($data);
        $this->redirect('/admin/team?success=created');
    }

    public function edit(int $id): void
    {
        $member = TeamMember::findById($id);
        if (!$member) {
            $this->redirect('/admin/team', ['error' => 'Team member not found.']);
            return;
        }
        $this->view('admin/team-form', ['member' => $member, 'errors' => [], 'old' => (array) $member, 'pageTitle' => 'Edit Team Member']);
    }

    public function update(int $id): void
    {
        $member = TeamMember::findById($id);
        if (!$member) {
            $this->redirect('/admin/team', ['error' => 'Team member not found.']);
            return;
        }

        $data   = $this->sanitize($_POST);
        $errors = $this->validate($data);

        $photoResult = $this->handleUpload();
        if (isset($photoResult['error'])) {
            $errors['photo'] = $photoResult['error'];
        } elseif ($photoResult['path']) {
            $data['photo'] = $photoResult['path'];
        } else {
            // keep existing photo
            $data['photo'] = $member->photo;
        }

        if ($errors) {
            $this->view('admin/team-form', ['member' => $member, 'errors' => $errors, 'old' => $data, 'pageTitle' => 'Edit Team Member']);
            return;
        }

        TeamMember::update($id, $data);
        $this->redirect('/admin/team?success=updated');
    }

    public function delete(int $id): void
    {
        TeamMember::delete($id);
        $this->redirect('/admin/team?success=deleted');
    }

    // ----------------------------------------------------------------
    private function sanitize(array $p): array
    {
        return [
            'name'       => trim($p['name']       ?? ''),
            'role'       => trim($p['role']       ?? ''),
            'initial'    => strtoupper(substr(trim($p['initial'] ?? ''), 0, 2)),
            'color'      => trim($p['color']      ?? '#176B23'),
            'bio'        => trim($p['bio']        ?? ''),
            'obj_pos'    => trim($p['obj_pos']    ?? 'center top'),
            'status'     => in_array($p['status'] ?? '', ['draft', 'published']) ? $p['status'] : 'published',
            'sort_order' => (int) ($p['sort_order'] ?? 0),
            'photo'      => trim($p['photo_path'] ?? ''), // manual path fallback
        ];
    }

    private function validate(array $d): array
    {
        $e = [];
        if ($d['name'] === '') $e['name'] = 'Name is required.';
        if ($d['role'] === '') $e['role'] = 'Role is required.';
        return $e;
    }

    /** Returns ['path' => string|null, 'error' => string|null] */
    private function handleUpload(): array
    {
        if (empty($_FILES['photo']['name'])) {
            return ['path' => null];
        }

        $file     = $_FILES['photo'];
        $allowed  = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $maxBytes = 3 * 1024 * 1024; // 3 MB

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['path' => null, 'error' => 'Upload error code: ' . $file['error']];
        }
        if (!in_array(mime_content_type($file['tmp_name']), $allowed)) {
            return ['path' => null, 'error' => 'Only JPEG, PNG, WebP, or GIF images are allowed.'];
        }
        if ($file['size'] > $maxBytes) {
            return ['path' => null, 'error' => 'Photo must be smaller than 3 MB.'];
        }

        $ext      = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = uniqid('team_', true) . '.' . $ext;
        $destDir  = \ROOT_PATH . '/' . self::UPLOAD_DIR;

        if (!is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }

        $dest = $destDir . $filename;
        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            return ['path' => null, 'error' => 'Could not save uploaded file.'];
        }

        return ['path' => self::UPLOAD_DIR . $filename];
    }
}
