<?php

namespace App\Controllers\Admin;

use App\Models\Service;

class ServiceAdminController {
    private function checkAuth() {
        if (empty($_SESSION['admin_user'])) {
            header('Location: ' . url('/admin/login'));
            exit;
        }
    }

    public function index() {
        $this->checkAuth();
        $services = Service::getAll();
        $title = "Hizmet Yönetimi - Miraç Su Panel";
        $activeAdminPage = 'services';

        require __DIR__ . '/../../../resources/views/admin/services.php';
    }

    public function store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $summary = trim($_POST['summary'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $icon = trim($_POST['icon'] ?? 'fa-wrench');
            $price = trim($_POST['price'] ?? 'Teklif Alınız');
            $isFeatured = isset($_POST['is_featured']) ? 1 : 0;

            if ($title) {
                Service::create([
                    'title' => $title,
                    'summary' => $summary,
                    'description' => $description,
                    'icon' => $icon,
                    'price' => $price,
                    'is_featured' => $isFeatured
                ]);
                $_SESSION['admin_flash'] = 'Yeni hizmet başarıyla eklendi.';
            }
        }
        header('Location: ' . url('/admin/services'));
        exit;
    }

    public function update() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $title = trim($_POST['title'] ?? '');
            $summary = trim($_POST['summary'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $icon = trim($_POST['icon'] ?? 'fa-wrench');
            $price = trim($_POST['price'] ?? 'Teklif Alınız');
            $isFeatured = isset($_POST['is_featured']) ? 1 : 0;

            if ($id > 0 && $title) {
                Service::update($id, [
                    'title' => $title,
                    'summary' => $summary,
                    'description' => $description,
                    'icon' => $icon,
                    'price' => $price,
                    'is_featured' => $isFeatured
                ]);
                $_SESSION['admin_flash'] = 'Hizmet bilgileri güncellendi.';
            }
        }
        header('Location: ' . url('/admin/services'));
        exit;
    }

    public function delete() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                Service::delete($id);
                $_SESSION['admin_flash'] = 'Hizmet silindi.';
            }
        }
        header('Location: ' . url('/admin/services'));
        exit;
    }
}
