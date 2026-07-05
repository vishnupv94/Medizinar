<?php

use App\Core\Router;
use App\Controllers\PageController;
use App\Controllers\ContactController;
use App\Controllers\AppointmentController;
use App\Controllers\BlogController;
use App\Controllers\ServiceController;
use App\Controllers\LocationController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\EntryController;
use App\Controllers\Admin\SettingsController;
use App\Controllers\Admin\BlogController as AdminBlogController;
use App\Controllers\FaqController;
use App\Controllers\SitemapController;
use App\Controllers\Admin\FaqController as AdminFaqController;
use App\Controllers\Admin\ServiceController as AdminServiceController;
use App\Controllers\Admin\LocationController as AdminLocationController;
use App\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Controllers\Admin\TeamController as AdminTeamController;
use App\Controllers\Admin\ContentController as AdminContentController;

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

$router->get('/faq',              [FaqController::class,        'index']);
$router->get('/sitemap.xml',      [SitemapController::class,    'index']);

// Individual service pages
$router->get('/services/{slug}',  [ServiceController::class,    'show']);

// Kerala location pages
$router->get('/location/{district}', [LocationController::class, 'show']);

$router->get('/privacy-policy',       [PageController::class, 'privacyPolicy']);
$router->get('/terms-and-conditions', [PageController::class, 'termsAndConditions']);
$router->get('/disclaimer',           [PageController::class, 'disclaimer']);
$router->get('/refund-policy',        [PageController::class, 'refundPolicy']);
$router->get('/grievance-policy',     [PageController::class, 'grievancePolicy']);
$router->get('/patient-rights',       [PageController::class, 'patientRights']);
$router->get('/service-terms',        [PageController::class, 'serviceTerms']);



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

// Admin: Services
$router->get('/admin/services',                 [AdminServiceController::class, 'index']);
$router->get('/admin/services/create',          [AdminServiceController::class, 'create']);
$router->post('/admin/services',               [AdminServiceController::class, 'store']);
$router->get('/admin/services/{id}/edit',       [AdminServiceController::class, 'edit']);
$router->post('/admin/services/{id}',          [AdminServiceController::class, 'update']);
$router->post('/admin/services/{id}/delete',   [AdminServiceController::class, 'delete']);

// Admin: Locations
$router->get('/admin/locations',                [AdminLocationController::class, 'index']);
$router->get('/admin/locations/create',         [AdminLocationController::class, 'create']);
$router->post('/admin/locations',              [AdminLocationController::class, 'store']);
$router->get('/admin/locations/{id}/edit',      [AdminLocationController::class, 'edit']);
$router->post('/admin/locations/{id}',         [AdminLocationController::class, 'update']);
$router->post('/admin/locations/{id}/delete',  [AdminLocationController::class, 'delete']);

// Admin: Testimonials
$router->get('/admin/testimonials',                [AdminTestimonialController::class, 'index']);
$router->get('/admin/testimonials/create',         [AdminTestimonialController::class, 'create']);
$router->post('/admin/testimonials',              [AdminTestimonialController::class, 'store']);
$router->get('/admin/testimonials/{id}/edit',      [AdminTestimonialController::class, 'edit']);
$router->post('/admin/testimonials/{id}',         [AdminTestimonialController::class, 'update']);
$router->post('/admin/testimonials/{id}/delete',  [AdminTestimonialController::class, 'delete']);

// Admin: Team Members
$router->get('/admin/team',                [AdminTeamController::class, 'index']);
$router->get('/admin/team/create',         [AdminTeamController::class, 'create']);
$router->post('/admin/team',              [AdminTeamController::class, 'store']);
$router->get('/admin/team/{id}/edit',      [AdminTeamController::class, 'edit']);
$router->post('/admin/team/{id}',         [AdminTeamController::class, 'update']);
$router->post('/admin/team/{id}/delete',  [AdminTeamController::class, 'delete']);

// Admin: Site Content
$router->get('/admin/content',                [AdminContentController::class, 'index']);
$router->get('/admin/content/create',         [AdminContentController::class, 'create']);
$router->post('/admin/content',              [AdminContentController::class, 'store']);
$router->get('/admin/content/{id}/edit',      [AdminContentController::class, 'edit']);
$router->post('/admin/content/{id}',         [AdminContentController::class, 'update']);
$router->post('/admin/content/{id}/delete',  [AdminContentController::class, 'delete']);

$router->get('/admin/settings',          [SettingsController::class, 'index']);
$router->post('/admin/settings',         [SettingsController::class, 'update']);
$router->post('/admin/settings/password', [SettingsController::class, 'changePassword']);

return $router;
