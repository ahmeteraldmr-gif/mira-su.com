<?php

use App\Controllers\HomeController;
use App\Controllers\AboutController;
use App\Controllers\ServiceController;
use App\Controllers\GalleryController;
use App\Controllers\ContactController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\BookingAdminController;
use App\Controllers\Admin\ServiceAdminController;
use App\Controllers\Admin\MessageAdminController;
use App\Controllers\Admin\SettingsAdminController;
use App\Controllers\Admin\GalleryAdminController;

return [
    // Front Routes
    'GET /' => [HomeController::class, 'index'],
    'POST /randevu-al' => [HomeController::class, 'book'],
    'GET /hakkimizda' => [AboutController::class, 'index'],
    'GET /hizmetler' => [ServiceController::class, 'index'],
    'GET /galeri' => [GalleryController::class, 'index'],
    'GET /iletisim' => [ContactController::class, 'index'],
    'POST /iletisim/gonder' => [ContactController::class, 'send'],

    // Admin Routes
    'GET /admin' => [AuthController::class, 'loginView'],
    'GET /admin/login' => [AuthController::class, 'loginView'],
    'POST /admin/login' => [AuthController::class, 'login'],
    'GET /admin/logout' => [AuthController::class, 'logout'],
    'GET /admin/dashboard' => [DashboardController::class, 'index'],
    'GET /admin/bookings' => [BookingAdminController::class, 'index'],
    'POST /admin/bookings/status' => [BookingAdminController::class, 'updateStatus'],
    'POST /admin/bookings/delete' => [BookingAdminController::class, 'delete'],
    'GET /admin/services' => [ServiceAdminController::class, 'index'],
    'POST /admin/services/store' => [ServiceAdminController::class, 'store'],
    'POST /admin/services/update' => [ServiceAdminController::class, 'update'],
    'POST /admin/services/delete' => [ServiceAdminController::class, 'delete'],
    'GET /admin/gallery' => [GalleryAdminController::class, 'index'],
    'POST /admin/gallery/store' => [GalleryAdminController::class, 'store'],
    'POST /admin/gallery/update' => [GalleryAdminController::class, 'update'],
    'POST /admin/gallery/delete' => [GalleryAdminController::class, 'delete'],
    'GET /admin/messages' => [MessageAdminController::class, 'index'],
    'POST /admin/messages/read' => [MessageAdminController::class, 'read'],
    'POST /admin/messages/delete' => [MessageAdminController::class, 'delete'],
    'GET /admin/settings' => [SettingsAdminController::class, 'index'],
    'POST /admin/settings/update' => [SettingsAdminController::class, 'update'],
];
