<?php

namespace App\Controllers\Admin;

use App\Models\Service;

class ServiceAdminController {
    private function checkAuth() {
        if (empty($_SESSION['admin_user'])) {
            header('Location: /admin/login');
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
            if ($title) {
                Service::create($_POST);
                $_SESSION['admin_flash'] = 'Yeni hizmet eklendi.';
            }
        }
        header('Location: /admin/services');
        exit;
    }

    public function update() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                Service::update($id, $_POST);
                $_SESSION['admin_flash'] = 'Hizmet güncellendi.';
            }
        }
        header('Location: /admin/services');
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
        header('Location: /admin/services');
        exit;
    }
}
