<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\ContactEntry;
use App\Models\AppointmentEntry;
use App\Models\BlogPost;

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
            'pageTitle'           => 'Dashboard',
            'adminPage'           => 'dashboard',
            'totalContacts'       => ContactEntry::count(),
            'unreadContacts'      => ContactEntry::countUnread(),
            'totalAppointments'   => AppointmentEntry::count(),
            'pendingAppointments' => AppointmentEntry::countByStatus('pending'),
            'recentContacts'      => ContactEntry::recent(5),
            'recentAppointments'  => AppointmentEntry::recent(5),
            'totalPosts'          => BlogPost::count(),
            'draftPosts'          => BlogPost::countDraft(),
            'recentPosts'         => BlogPost::recent(5),
        ]);
    }
}
