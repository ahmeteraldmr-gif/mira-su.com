<?php

namespace App\Controllers;

use App\Models\Setting;
use App\Models\ContactMessage;

class ContactController {
    public function index() {
        $settings = Setting::getAll();
        $title = "İletişim - Miraç Su Tesisatı & Arıtma Sistemleri";
        $activePage = 'contact';

        require __DIR__ . '/../../resources/views/contact.php';
    }

    public function send() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $subject = trim($_POST['subject'] ?? 'Genel İletişim');
            $message = trim($_POST['message'] ?? '');

            if ($name && $phone && $message) {
                ContactMessage::create([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'subject' => $subject,
                    'message' => $message
                ]);
                $_SESSION['flash_success'] = 'Mesajınız başarıyla iletildi! En kısa sürede tarafınıza dönüş yapılacaktır.';
            } else {
                $_SESSION['flash_error'] = 'Lütfen zorunlu alanları (Ad Soyad, Telefon ve Mesaj) doldurunuz.';
            }
            header('Location: /iletisim');
            exit;
        }
    }
}
