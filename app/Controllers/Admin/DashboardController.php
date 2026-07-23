<?php

namespace App\Controllers\Admin;

use App\Models\Booking;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\Setting;

class DashboardController {
    private function checkAuth() {
        if (empty($_SESSION['admin_user'])) {
            header('Location: /admin/login');
            exit;
        }
    }

    public function index() {
        $this->checkAuth();

        $totalBookings = Booking::getCount();
        $pendingBookings = Booking::getPendingCount();
        $unreadMessages = ContactMessage::getUnreadCount();
        $servicesCount = count(Service::getAll());

        $recentBookings = array_slice(Booking::getAll(), 0, 5);
        $recentMessages = array_slice(ContactMessage::getAll(), 0, 5);

        $title = "Yönetim Paneli - Miraç Su Tesisatı";
        $activeAdminPage = 'dashboard';

        require __DIR__ . '/../../../resources/views/admin/dashboard.php';
    }
}
