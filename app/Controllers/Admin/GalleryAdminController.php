<?php

namespace App\Controllers\Admin;

use App\Models\GalleryItem;

class GalleryAdminController {
    private function checkAuth() {
        if (empty($_SESSION['admin_user'])) {
            header('Location: ' . url('/admin/login'));
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

            if (!empty($_FILES['image_file']['name'])) {
                $file = $_FILES['image_file'];
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                    $possibleDirs = [
                        __DIR__ . '/../../../public/images',
                        dirname($_SERVER['SCRIPT_FILENAME'] ?? '') . '/images',
                        dirname($_SERVER['SCRIPT_FILENAME'] ?? '') . '/public/images'
                    ];

                    $uploaded = false;
                    $newName = 'gallery_' . time() . '_' . rand(100, 999) . '.' . $ext;

                    foreach ($possibleDirs as $imgDir) {
                        if (!file_exists($imgDir)) {
                            @mkdir($imgDir, 0777, true);
                        }
                        @chmod($imgDir, 0777);

                        $targetPath = $imgDir . '/' . $newName;
                        if (@move_uploaded_file($file['tmp_name'], $targetPath)) {
                            @chmod($targetPath, 0644);
                            $imageUrl = '/images/' . $newName;
                            $uploaded = true;
                            break;
                        }
                    }

                    if (!$uploaded) {
                        $_SESSION['admin_error'] = 'Dosya sunucuya yazılamadı. Lütfen SSH terminalinde "chmod -R 777 public/images" çalıştırın.';
                    }
                } else {
                    $_SESSION['admin_error'] = 'Geçersiz dosya formatı. Lütfen JPG, PNG veya WEBP yükleyin.';
                }
            }

            if ($title && $imageUrl) {
                GalleryItem::create([
                    'title' => $title,
                    'category' => $category,
                    'image_url' => $imageUrl,
                    'description' => $description
                ]);
                if (empty($_SESSION['admin_error'])) {
                    $_SESSION['admin_flash'] = 'Galeriye yeni fotoğraf başarıyla eklendi.';
                }
            }
        }
        header('Location: ' . url('/admin/gallery'));
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
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                    $possibleDirs = [
                        __DIR__ . '/../../../public/images',
                        dirname($_SERVER['SCRIPT_FILENAME'] ?? '') . '/images',
                        dirname($_SERVER['SCRIPT_FILENAME'] ?? '') . '/public/images'
                    ];

                    $uploaded = false;
                    $newName = 'gallery_' . time() . '_' . rand(100, 999) . '.' . $ext;

                    foreach ($possibleDirs as $imgDir) {
                        if (!file_exists($imgDir)) {
                            @mkdir($imgDir, 0777, true);
                        }
                        @chmod($imgDir, 0777);

                        $targetPath = $imgDir . '/' . $newName;
                        if (@move_uploaded_file($file['tmp_name'], $targetPath)) {
                            @chmod($targetPath, 0644);
                            $imageUrl = '/images/' . $newName;
                            $uploaded = true;
                            break;
                        }
                    }

                    if (!$uploaded) {
                        $_SESSION['admin_error'] = 'Dosya sunucuya yazılamadı. Lütfen SSH terminalinde "chmod -R 777 public/images" çalıştırın.';
                    }
                } else {
                    $_SESSION['admin_error'] = 'Geçersiz dosya formatı. Lütfen JPG, PNG veya WEBP yükleyin.';
                }
            }

            if ($id > 0 && $title && $imageUrl) {
                GalleryItem::update($id, [
                    'title' => $title,
                    'category' => $category,
                    'image_url' => $imageUrl,
                    'description' => $description
                ]);
                if (empty($_SESSION['admin_error'])) {
                    $_SESSION['admin_flash'] = 'Fotoğraf bilgileri başarıyla güncellendi.';
                }
            }
        }
        header('Location: ' . url('/admin/gallery'));
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
        header('Location: ' . url('/admin/gallery'));
        exit;
    }
}
