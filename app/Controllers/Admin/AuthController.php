<?php

namespace App\Controllers\Admin;

use App\Models\User;

class AuthController {
    public function loginView() {
        if (!empty($_SESSION['admin_user'])) {
            header('Location: /admin/dashboard');
            exit;
        }
        $title = "Yönetici Girişi - Miraç Su Panel";
        require __DIR__ . '/../../../resources/views/admin/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            $user = User::authenticate($username, $password);
            if ($user) {
                $_SESSION['admin_user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'username' => $user['username']
                ];
                header('Location: /admin/dashboard');
                exit;
            } else {
                $_SESSION['admin_error'] = 'Kullanıcı adı veya şifre hatalı!';
                header('Location: /admin/login');
                exit;
            }
        }
    }

    public function logout() {
        unset($_SESSION['admin_user']);
        session_destroy();
        header('Location: /admin/login');
        exit;
    }
}
