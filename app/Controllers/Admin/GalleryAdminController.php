<?php

namespace App\Controllers\Admin;

use App\Models\GalleryItem;

class GalleryAdminController {
    private function checkAuth() {
        if (empty($_SESSION['admin_user'])) {
            header('Location: /admin/login');
            exit;
        }
    }

    public function index() {
        $this->checkAuth();
        $items = GalleryItem::getAll();
        $title = "Galeri Yönetimi - Miraç Su Panel";
        $activeAdminPage = 'gallery';

        require __DIR__ . '/../../../resources/views/admin/gallery.php';
    }

    public function store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $imageUrl = trim($_POST['image_url'] ?? '');
            $category = trim($_POST['category'] ?? 'kacak');
            $description = trim($_POST['description'] ?? '');

            // Support image upload if file is posted
            if (!empty($_FILES['image_file']['name'])) {
                $file = $_FILES['image_file'];
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $newName = 'gallery_upload_' . time() . '.' . $ext;
                    $targetPath = __DIR__ . '/../../../public/images/' . $newName;
                    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                        $imageUrl = '/images/' . $newName;
                    }
                }
            }

            if ($title && $imageUrl) {
                GalleryItem::create([
                    'title' => $title,
                    'category' => $category,
                    'image_url' => $imageUrl,
                    'description' => $description
                ]);
                $_SESSION['admin_flash'] = 'Galeriye yeni fotoğraf eklendi.';
            }
        }
        header('Location: /admin/gallery');
        exit;
    }

    public function update() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            $title = trim($_POST['title'] ?? '');
            $imageUrl = trim($_POST['image_url'] ?? '');
            $category = trim($_POST['category'] ?? 'kacak');
            $description = trim($_POST['description'] ?? '');

            if (!empty($_FILES['image_file']['name'])) {
                $file = $_FILES['image_file'];
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                    $newName = 'gallery_upload_' . time() . '.' . $ext;
                    $targetPath = __DIR__ . '/../../../public/images/' . $newName;
                    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                        $imageUrl = '/images/' . $newName;
                    }
                }
            }

            if ($id > 0 && $title && $imageUrl) {
                GalleryItem::update($id, [
                    'title' => $title,
                    'category' => $category,
                    'image_url' => $imageUrl,
                    'description' => $description
                ]);
                $_SESSION['admin_flash'] = 'Fotoğraf bilgileri güncellendi.';
            }
        }
        header('Location: /admin/gallery');
        exit;
    }

    public function delete() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                GalleryItem::delete($id);
                $_SESSION['admin_flash'] = 'Fotoğraf galeriden silindi.';
            }
        }
        header('Location: /admin/gallery');
        exit;
    }
}
