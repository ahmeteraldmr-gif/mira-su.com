<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Setting {
    public static function getAll(): array {
        $db = Database::getConnection();
        $rows = $db->query("SELECT key, value FROM settings")->fetchAll();
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['key']] = $row['value'];
        }
        return $settings;
    }

    public static function get(string $key, string $default = ''): string {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT value FROM settings WHERE key = ?");
        $stmt->execute([$key]);
        $row = $stmt->fetch();
        return $row ? $row['value'] : $default;
    }

    public static function updateMany(array $data): void {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT OR REPLACE INTO settings (key, value) VALUES (?, ?)");
        foreach ($data as $key => $value) {
            $stmt->execute([$key, $value]);
        }
    }
}
