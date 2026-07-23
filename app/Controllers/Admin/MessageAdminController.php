<?php

namespace App\Controllers\Admin;

use App\Models\ContactMessage;

class MessageAdminController {
    private function checkAuth() {
        if (empty($_SESSION['admin_user'])) {
            header('Location: /admin/login');
            exit;
        }
    }

    public function index() {
        $this->checkAuth();
        $messages = ContactMessage::getAll();
        $title = "Gelen Mesajlar - Miraç Su Panel";
        $activeAdminPage = 'messages';

        require __DIR__ . '/../../../resources/views/admin/messages.php';
    }

    public function read() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                ContactMessage::markAsRead($id);
                $_SESSION['admin_flash'] = 'Mesaj okundu olarak işaretlendi.';
            }
        }
        header('Location: /admin/messages');
        exit;
    }

    public function delete() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                ContactMessage::delete($id);
                $_SESSION['admin_flash'] = 'Mesaj silindi.';
            }
        }
        header('Location: /admin/messages');
        exit;
    }
}
