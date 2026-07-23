<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class GalleryItem {
    public static function getAll(): array {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM gallery_items ORDER BY id DESC")->fetchAll();
    }

    public static function getByCategory(string $category): array {
        if ($category === 'all') return self::getAll();
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM gallery_items WHERE category = ? ORDER BY id DESC");
        $stmt->execute([$category]);
        return $stmt->fetchAll();
    }

    public static function findById(int $id): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM gallery_items WHERE id = ?");
        $stmt->execute([$id]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public static function create(array $data): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO gallery_items (title, category, image_url, description) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['title'],
            $data['category'] ?? 'kacak',
            $data['image_url'],
            $data['description'] ?? ''
        ]);
    }

    public static function update(int $id, array $data): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE gallery_items SET title = ?, category = ?, image_url = ?, description = ? WHERE id = ?");
        return $stmt->execute([
            $data['title'],
            $data['category'] ?? 'kacak',
            $data['image_url'],
            $data['description'] ?? '',
            $id
        ]);
    }

    public static function delete(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM gallery_items WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
