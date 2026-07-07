<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Helpers\Csrf;
use App\Models\ContactEntry;
use App\Models\AppointmentEntry;

class EntryController extends Controller
{
    public function __construct()
    {
        $this->layout = 'admin';
        $this->guardAdmin();
    }

    public function contactList(): void
    {
        $q      = sanitize_input($_GET['q'] ?? '');
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $limit  = 20;
        $offset = ($page - 1) * $limit;
        $total  = ContactEntry::countFiltered($q);
        $pages  = max(1, (int) ceil($total / $limit));

        $this->view('admin/contact-entries', [
            'pageTitle'  => 'Contact Entries',
            'adminPage'  => 'contacts',
            'entries'    => ContactEntry::getFiltered($q, $limit, $offset),
            'page'       => $page,
            'totalPages' => $pages,
            'total'      => $total,
            'q'          => $q,
        ]);
    }

    public function contactDetail(string $id): void
    {
        $entry = ContactEntry::findById((int) $id);

        if (!$entry) {
            $this->redirect(url('/admin/entries/contact'), ['error' => 'Entry not found.']);
        }

        if (!$entry->is_read) {
            ContactEntry::markRead($entry->id);
            $entry->is_read = 1;
        }

        $this->view('admin/contact-detail', [
            'pageTitle' => 'Contact #' . $entry->id,
            'adminPage' => 'contacts',
            'entry'     => $entry,
        ]);
    }

    public function contactDelete(string $id): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/entries/contact'));
        }

        ContactEntry::delete((int) $id);
        $this->redirect(url('/admin/entries/contact'), ['success' => 'Contact entry deleted.']);
    }

    public function appointmentList(): void
    {
        $q      = sanitize_input($_GET['q'] ?? '');
        $status = sanitize_input($_GET['status'] ?? '');
        if (!in_array($status, ['', 'pending', 'confirmed', 'completed', 'cancelled'], true)) {
            $status = '';
        }

        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $limit  = 20;
        $offset = ($page - 1) * $limit;
        $total  = AppointmentEntry::countFiltered($q, $status);
        $pages  = max(1, (int) ceil($total / $limit));

        $this->view('admin/appointment-entries', [
            'pageTitle'  => 'Appointment Entries',
            'adminPage'  => 'appointments',
            'entries'    => AppointmentEntry::getFiltered($q, $status, $limit, $offset),
            'page'       => $page,
            'totalPages' => $pages,
            'total'      => $total,
            'q'          => $q,
            'status'     => $status,
        ]);
    }

    public function appointmentDetail(string $id): void
    {
        $entry = AppointmentEntry::findById((int) $id);

        if (!$entry) {
            $this->redirect(url('/admin/entries/appointments'), ['error' => 'Entry not found.']);
        }

        if (!$entry->is_read) {
            AppointmentEntry::markRead($entry->id);
            $entry->is_read = 1;
        }

        $this->view('admin/appointment-detail', [
            'pageTitle' => 'Appointment #' . $entry->id,
            'adminPage' => 'appointments',
            'entry'     => $entry,
        ]);
    }

    public function appointmentStatus(string $id): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/entries/appointments'));
        }

        $status = sanitize_input($_POST['status'] ?? '');
        AppointmentEntry::updateStatus((int) $id, $status);

        $this->redirect(url("/admin/entries/appointments/{$id}"), ['success' => 'Status updated.']);
    }

    public function appointmentDelete(string $id): void
    {
        if (!Csrf::verify($_POST['csrf_token'] ?? '')) {
            $this->redirect(url('/admin/entries/appointments'));
        }

        AppointmentEntry::delete((int) $id);
        $this->redirect(url('/admin/entries/appointments'), ['success' => 'Appointment entry deleted.']);
    }

    /**
     * Serve a contact attachment through PHP (uploads/ dir stays blocked publicly).
     * Route: GET /admin/entries/contact/{id}/attachment
     */
    public function serveAttachment(string $id): void
    {
        $entry = ContactEntry::findById((int) $id);

        if (!$entry || empty($entry->attachment_path)) {
            http_response_code(404);
            exit('Attachment not found.');
        }

        // Sanitise: only allow the basename stored in DB (prevents path traversal)
        $safeName = basename($entry->attachment_path);
        $filePath = ROOT_PATH . '/uploads/contact/' . $safeName;

        if (!file_exists($filePath) || !is_file($filePath)) {
            http_response_code(404);
            exit('File not found on server.');
        }

        $ext      = strtolower(pathinfo($safeName, PATHINFO_EXTENSION));
        $mimeMap  = [
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
            'gif'  => 'image/gif',
            'webp' => 'image/webp',
            'pdf'  => 'application/pdf',
            'doc'  => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];
        $mime = $mimeMap[$ext] ?? 'application/octet-stream';

        // Inline for images/PDF so they preview in browser; force-download otherwise
        $inline = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'pdf']);

        header('Content-Type: ' . $mime);
        header('Content-Length: ' . filesize($filePath));
        header('Content-Disposition: ' . ($inline ? 'inline' : 'attachment') . '; filename="' . addslashes($entry->attachment_name) . '"');
        header('Cache-Control: private, no-cache');
        header('X-Content-Type-Options: nosniff');

        readfile($filePath);
        exit;
    }
}
