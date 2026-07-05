<?php
use App\Models\ContactEntry;
use App\Models\AppointmentEntry;
use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\Service;
use App\Models\Location;

$unreadContacts      = ContactEntry::countUnread();
$pendingAppointments = AppointmentEntry::countByStatus('pending');
$draftPosts          = BlogPost::countDraft();
$draftFaqs           = Faq::countDraft();
$draftServices       = Service::countDraft();
$draftLocations      = Location::countDraft();

$links = [
    ['href' => '/admin/dashboard',            'key' => 'dashboard',    'label' => 'Dashboard',       'badge' => 0,                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1h-2z"/>'],
    ['href' => '/admin/entries/contact',      'key' => 'contacts',     'label' => 'Contact Entries', 'badge' => $unreadContacts,      'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
    ['href' => '/admin/entries/appointments', 'key' => 'appointments', 'label' => 'Appointments',    'badge' => $pendingAppointments, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>'],
    ['href' => '/admin/blog',                 'key' => 'blog',         'label' => 'Blog Posts',      'badge' => $draftPosts,          'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>'],
    ['href' => '/admin/faqs',                 'key' => 'faqs',         'label' => 'FAQs',            'badge' => $draftFaqs,           'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
    ['href' => '/admin/services',             'key' => 'services',     'label' => 'Services',        'badge' => $draftServices,       'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-2 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>'],
    ['href' => '/admin/locations',            'key' => 'locations',    'label' => 'Locations',       'badge' => $draftLocations,      'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>'],
    ['href' => '/admin/settings',             'key' => 'settings',     'label' => 'Settings',        'badge' => 0,                    'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>'],
];
?>

<!-- Mobile overlay (hidden by default, shown when sidebar open) -->
<div id="admin-overlay"
     class="fixed inset-0 bg-black/50 z-30 lg:hidden hidden"
     onclick="closeSidebar()" aria-hidden="true"></div>

<!-- Sidebar -->
<aside id="admin-sidebar"
       class="fixed inset-y-0 left-0 z-40 w-64 bg-sidebar flex flex-col flex-shrink-0 h-full
              -translate-x-full transition-transform duration-300 ease-in-out
              lg:relative lg:translate-x-0 lg:z-auto">

    <div class="h-16 flex items-center px-5 border-b border-gray-700">
        <a href="<?= url('/admin/dashboard') ?>" class="flex items-center gap-2 flex-1">
            <span class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
            </span>
            <span class="text-white font-semibold text-sm tracking-wide"><?= SITE_NAME ?></span>
        </a>
        <!-- Close button (mobile only) -->
        <button onclick="closeSidebar()" class="lg:hidden p-1 text-gray-400 hover:text-white" aria-label="Close menu">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 admin-scrollbar">
        <?php foreach ($links as $link): ?>
            <?php $active = ($adminPage ?? '') === $link['key']; ?>
            <a href="<?= url($link['href']) ?>"
                onclick="closeSidebar()"
                class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                      <?= $active ? 'bg-sidebar-active text-white' : 'text-gray-400 hover:bg-sidebar-hover hover:text-white' ?>">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><?= $link['icon'] ?></svg>
                <span class="flex-1"><?= $link['label'] ?></span>
                <?php if (!empty($link['badge'])): ?>
                    <span class="ml-auto text-xs font-bold bg-red-500 text-white rounded-full min-w-[1.25rem] h-5 px-1 flex items-center justify-center leading-none">
                        <?= $link['badge'] > 99 ? '99+' : $link['badge'] ?>
                    </span>
                <?php endif; ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="px-3 py-4 border-t border-gray-700">
        <a href="<?= url('/') ?>" target="_blank"
            class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-500 hover:text-gray-300 hover:bg-sidebar-hover transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
            View Website
        </a>
    </div>
</aside>

<script>
function openSidebar() {
    document.getElementById('admin-sidebar').classList.remove('-translate-x-full');
    document.getElementById('admin-overlay').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closeSidebar() {
    document.getElementById('admin-sidebar').classList.add('-translate-x-full');
    document.getElementById('admin-overlay').classList.add('hidden');
    document.body.style.overflow = '';
}
</script>