<?php

use App\Core\Router;
use App\Controllers\PageController;
use App\Controllers\ContactController;
use App\Controllers\AppointmentController;
use App\Controllers\BlogController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\EntryController;
use App\Controllers\Admin\SettingsController;
use App\Controllers\Admin\BlogController as AdminBlogController;
use App\Controllers\FaqController;
use App\Controllers\SitemapController;
use App\Controllers\Admin\FaqController as AdminFaqController;

$router = new Router();

$router->get('/',           [PageController::class,        'home']);
$router->get('/about',      [PageController::class,        'about']);
$router->get('/services',   [PageController::class,        'services']);
$router->get('/team',       [PageController::class,        'team']);

$router->get('/contact',    [ContactController::class,     'index']);
$router->post('/contact',   [ContactController::class,     'submit']);

$router->get('/appointment',  [AppointmentController::class, 'index']);
$router->post('/appointment', [AppointmentController::class, 'submit']);

$router->get('/blog',        [BlogController::class,       'index']);
$router->get('/blog/{slug}', [BlogController::class,       'show']);

$router->get('/faq',         [FaqController::class,        'index']);
$router->get('/sitemap.xml',  [SitemapController::class,    'index']);

$router->get('/admin/login',  [AuthController::class,      'loginForm']);
$router->post('/admin/login', [AuthController::class,      'login']);
$router->post('/admin/logout', [AuthController::class,      'logout']);

$router->get('/admin',          [DashboardController::class, 'index']);
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

$router->get('/admin/entries/contact',               [EntryController::class, 'contactList']);
$router->get('/admin/entries/contact/{id}',          [EntryController::class, 'contactDetail']);
$router->get('/admin/entries/contact/{id}/attachment', [EntryController::class, 'serveAttachment']);
$router->post('/admin/entries/contact/{id}/delete',  [EntryController::class, 'contactDelete']);

$router->get('/admin/entries/appointments',               [EntryController::class, 'appointmentList']);
$router->get('/admin/entries/appointments/{id}',          [EntryController::class, 'appointmentDetail']);
$router->post('/admin/entries/appointments/{id}/status',  [EntryController::class, 'appointmentStatus']);
$router->post('/admin/entries/appointments/{id}/delete',  [EntryController::class, 'appointmentDelete']);

$router->get('/admin/blog',                [AdminBlogController::class, 'index']);
$router->get('/admin/blog/create',         [AdminBlogController::class, 'create']);
$router->post('/admin/blog',              [AdminBlogController::class, 'store']);
$router->get('/admin/blog/{id}/edit',      [AdminBlogController::class, 'edit']);
$router->post('/admin/blog/{id}',         [AdminBlogController::class, 'update']);
$router->get('/admin/blog/{id}/preview',   [AdminBlogController::class, 'preview']);
$router->post('/admin/blog/{id}/delete',  [AdminBlogController::class, 'delete']);

$router->get('/admin/faqs',                [AdminFaqController::class, 'index']);
$router->get('/admin/faqs/create',         [AdminFaqController::class, 'create']);
$router->post('/admin/faqs',              [AdminFaqController::class, 'store']);
$router->get('/admin/faqs/{id}/edit',      [AdminFaqController::class, 'edit']);
$router->post('/admin/faqs/{id}',         [AdminFaqController::class, 'update']);
$router->post('/admin/faqs/{id}/delete',  [AdminFaqController::class, 'delete']);

$router->get('/admin/settings',          [SettingsController::class, 'index']);
$router->post('/admin/settings',         [SettingsController::class, 'update']);
$router->post('/admin/settings/password', [SettingsController::class, 'changePassword']);

return $router;
