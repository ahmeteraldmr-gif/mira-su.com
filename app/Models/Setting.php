<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class Setting {
    public static function getAll(): array {
        $db = Database::getConnection();
        try {
            $rows = $db->query("SELECT setting_key as `key`, setting_value as `value` FROM settings")->fetchAll();
        } catch (\Throwable $e) {
            // Fallback for old schema if key/value columns were used
            $rows = $db->query("SELECT `key`, `value` FROM settings")->fetchAll();
        }
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['key']] = $row['value'];
        }
        return $settings;
    }

    public static function get(string $key, string $default = ''): string {
        $db = Database::getConnection();
        try {
            $stmt = $db->prepare("SELECT setting_value as `value` FROM settings WHERE setting_key = ?");
            $stmt->execute([$key]);
            $row = $stmt->fetch();
        } catch (\Throwable $e) {
            $stmt = $db->prepare("SELECT `value` FROM settings WHERE `key` = ?");
            $stmt->execute([$key]);
            $row = $stmt->fetch();
        }
        return $row ? $row['value'] : $default;
    }

    public static function updateMany(array $data): void {
        $db = Database::getConnection();
        $driver = env('DB_CONNECTION', 'mysql');

        if ($driver === 'mysql') {
            $stmt = $db->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
        } else {
            $stmt = $db->prepare("INSERT OR REPLACE INTO settings (setting_key, setting_value) VALUES (?, ?)");
        }

        foreach ($data as $key => $value) {
            $stmt->execute([$key, $value]);
        }
    }
}
