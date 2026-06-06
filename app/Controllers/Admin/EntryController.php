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
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $limit  = 20;
        $offset = ($page - 1) * $limit;
        $total  = ContactEntry::count();
        $pages  = max(1, (int) ceil($total / $limit));

        $this->view('admin/contact-entries', [
            'pageTitle'  => 'Contact Entries',
            'adminPage'  => 'contacts',
            'entries'    => ContactEntry::getAll($limit, $offset),
            'page'       => $page,
            'totalPages' => $pages,
            'total'      => $total,
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
        $page   = max(1, (int) ($_GET['page'] ?? 1));
        $limit  = 20;
        $offset = ($page - 1) * $limit;
        $total  = AppointmentEntry::count();
        $pages  = max(1, (int) ceil($total / $limit));

        $this->view('admin/appointment-entries', [
            'pageTitle'  => 'Appointment Entries',
            'adminPage'  => 'appointments',
            'entries'    => AppointmentEntry::getAll($limit, $offset),
            'page'       => $page,
            'totalPages' => $pages,
            'total'      => $total,
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
}
