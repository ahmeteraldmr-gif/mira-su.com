<?php

namespace App\Controllers\Admin;

use App\Models\Booking;

class BookingAdminController {
    private function checkAuth() {
        if (empty($_SESSION['admin_user'])) {
            header('Location: ' . url('/admin/login'));
            exit;
        }
    }

    public function index() {
        $this->checkAuth();
        $bookings = Booking::getAll();
        $title = "Servis Talepleri - Miraç Su Panel";
        $activeAdminPage = 'bookings';

        require __DIR__ . '/../../../resources/views/admin/bookings.php';
    }

    public function updateStatus() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $status = trim($_POST['status'] ?? 'Bekliyor');
            if ($id > 0) {
                Booking::updateStatus($id, $status);
                $_SESSION['admin_flash'] = 'Talep durumu güncellendi.';
            }
        }
        header('Location: ' . url('/admin/bookings'));
        exit;
    }

    public function delete() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                Booking::delete($id);
                $_SESSION['admin_flash'] = 'Servis talebi silindi.';
            }
        }
        header('Location: ' . url('/admin/bookings'));
        exit;
    }
}
