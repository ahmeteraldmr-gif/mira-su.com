<?php

namespace App\Controllers\Admin;

use App\Models\Setting;

class SettingsAdminController {
    private function checkAuth() {
        if (empty($_SESSION['admin_user'])) {
            header('Location: /admin/login');
            exit;
        }
    }

    public function index() {
        $this->checkAuth();
        $settings = Setting::getAll();
        $title = "Site Ayarları - Miraç Su Panel";
        $activeAdminPage = 'settings';

        require __DIR__ . '/../../../resources/views/admin/settings.php';
    }

    public function update() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'site_name' => trim($_POST['site_name'] ?? ''),
                'site_phone' => trim($_POST['site_phone'] ?? ''),
                'site_whatsapp' => trim($_POST['site_whatsapp'] ?? ''),
                'site_emergency' => trim($_POST['site_emergency'] ?? ''),
                'site_email' => trim($_POST['site_email'] ?? ''),
                'site_address' => trim($_POST['site_address'] ?? ''),
                'working_hours' => trim($_POST['working_hours'] ?? ''),
                'about_story' => trim($_POST['about_story'] ?? ''),
                'about_mission' => trim($_POST['about_mission'] ?? ''),
                'about_vision' => trim($_POST['about_vision'] ?? ''),
                'facebook_url' => trim($_POST['facebook_url'] ?? ''),
                'instagram_url' => trim($_POST['instagram_url'] ?? '')
            ];

            Setting::updateMany($data);
            $_SESSION['admin_flash'] = 'Site ayarları başarıyla güncellendi.';
        }
        header('Location: /admin/settings');
        exit;
    }
}
