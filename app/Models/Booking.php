<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Booking {
    public static function getAll(): array {
        $db = Database::getConnection();
        return $db->query("SELECT * FROM bookings ORDER BY id DESC")->fetchAll();
    }

    public static function getCount(): int {
        $db = Database::getConnection();
        return (int)$db->query("SELECT COUNT(*) FROM bookings")->fetchColumn();
    }

    public static function getPendingCount(): int {
        $db = Database::getConnection();
        return (int)$db->query("SELECT COUNT(*) FROM bookings WHERE status = 'Bekliyor'")->fetchColumn();
    }

    public static function create(array $data): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO bookings (name, phone, service_name, address, notes, status) VALUES (?, ?, ?, ?, ?, 'Bekliyor')");
        return $stmt->execute([
            $data['name'],
            $data['phone'],
            $data['service_name'] ?? 'Genel Tesisat Servisi',
            $data['address'],
            $data['notes'] ?? ''
        ]);
    }

    public static function updateStatus(int $id, string $status): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public static function delete(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM bookings WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
