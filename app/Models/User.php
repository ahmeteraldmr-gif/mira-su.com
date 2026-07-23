<?php

namespace App\Models;

use App\Database\Database;
use PDO;

class User {
    public static function authenticate(string $username, string $password): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return null;
    }
}
