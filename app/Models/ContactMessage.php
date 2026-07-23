<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class ContactMessage {
    public static function getAll(): array {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM contact_messages ORDER BY id DESC")->fetchAll();
    }

    public static function getUnreadCount(): int {
        $db = Database::getConnection();
        return (int)$db->query("SELECT COUNT(*) FROM contact_messages WHERE is_read = 0")->fetchColumn();
    }

    public static function create(array $data): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO contact_messages (name, email, phone, subject, message, is_read) VALUES (?, ?, ?, ?, ?, 0)");
        return $stmt->execute([
            $data['name'],
            $data['email'] ?? '',
            $data['phone'],
            $data['subject'] ?? 'İletişim Mesajı',
            $data['message']
        ]);
    }

    public static function markAsRead(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function delete(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM contact_messages WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
