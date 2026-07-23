<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Service {
    public static function getActive(): array {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM services WHERE is_active = 1 ORDER BY is_featured DESC, id ASC")->fetchAll();
    }

    public static function getAll(): array {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM services ORDER BY id DESC")->fetchAll();
    }

    public static function getFeatured(): array {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM services WHERE is_active = 1 AND is_featured = 1 ORDER BY id ASC")->fetchAll();
    }

    public static function findBySlug(string $slug): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM services WHERE slug = ? AND is_active = 1");
        $stmt->execute([$slug]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public static function findById(int $id): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM services WHERE id = ?");
        $stmt->execute([$id]);
        $res = $stmt->fetch();
        return $res ?: null;
    }

    public static function create(array $data): bool {
        $db = Database::getConnection();
        $slug = self::slugify($data['title']);
        $stmt = $db->prepare("INSERT INTO services (title, slug, summary, description, icon, price, is_featured, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['title'],
            $slug,
            $data['summary'] ?? '',
            $data['description'] ?? '',
            $data['icon'] ?? 'fa-wrench',
            $data['price'] ?? 'Teklif Alın',
            isset($data['is_featured']) ? 1 : 0,
            isset($data['is_active']) ? 1 : 0
        ]);
    }

    public static function update(int $id, array $data): bool {
        $db = Database::getConnection();
        $slug = self::slugify($data['title']);
        $stmt = $db->prepare("UPDATE services SET title = ?, slug = ?, summary = ?, description = ?, icon = ?, price = ?, is_featured = ?, is_active = ? WHERE id = ?");
        return $stmt->execute([
            $data['title'],
            $slug,
            $data['summary'] ?? '',
            $data['description'] ?? '',
            $data['icon'] ?? 'fa-wrench',
            $data['price'] ?? 'Teklif Alın',
            isset($data['is_featured']) ? 1 : 0,
            isset($data['is_active']) ? 1 : 0,
            $id
        ]);
    }

    public static function delete(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM services WHERE id = ?");
        return $stmt->execute([$id]);
    }

    private static function slugify(string $text): string {
        $tr = ['ş'=>'s', 'Ş'=>'s', 'ı'=>'i', 'İ'=>'i', 'ğ'=>'g', 'Ğ'=>'g', 'ü'=>'u', 'Ü'=>'u', 'ö'=>'o', 'Ö'=>'o', 'ç'=>'c', 'Ç'=>'c'];
        $text = strtr($text, $tr);
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9-]/', '-', $text);
        return preg_replace('/-+/', '-', $text);
    }
}
