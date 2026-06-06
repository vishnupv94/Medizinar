<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ContactEntry;
use App\Models\AppointmentEntry;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->layout = 'admin';
        $this->guardAdmin();
    }

    public function index(): void
    {
        $this->view('admin/dashboard', [
            'pageTitle'          => 'Dashboard',
            'adminPage'          => 'dashboard',
            'totalContacts'      => ContactEntry::count(),
            'unreadContacts'     => ContactEntry::countUnread(),
            'totalAppointments'  => AppointmentEntry::count(),
            'pendingAppointments' => AppointmentEntry::countByStatus('pending'),
            'recentContacts'     => ContactEntry::recent(5),
            'recentAppointments' => AppointmentEntry::recent(5),
        ]);
    }
}
