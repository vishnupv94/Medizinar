<?php

use App\Core\Router;
use App\Controllers\PageController;
use App\Controllers\ContactController;
use App\Controllers\AppointmentController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\EntryController;
use App\Controllers\Admin\SettingsController;

$router = new Router();

$router->get('/',           [PageController::class,        'home']);
$router->get('/about',      [PageController::class,        'about']);
$router->get('/services',   [PageController::class,        'services']);
$router->get('/team',       [PageController::class,        'team']);

$router->get('/contact',    [ContactController::class,     'index']);
$router->post('/contact',   [ContactController::class,     'submit']);

$router->get('/appointment',  [AppointmentController::class, 'index']);
$router->post('/appointment', [AppointmentController::class, 'submit']);

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

$router->get('/admin/settings',          [SettingsController::class, 'index']);
$router->post('/admin/settings',         [SettingsController::class, 'update']);
$router->post('/admin/settings/password', [SettingsController::class, 'changePassword']);

return $router;
