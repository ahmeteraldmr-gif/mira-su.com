<?php

namespace App\Controllers;

use App\Models\Service;
use App\Models\Setting;
use App\Models\Booking;

class HomeController {
    public function index() {
        $services = Service::getFeatured();
        $settings = Setting::getAll();
        
        $title = "Miraç Su Tesisatı & Arıtma Sistemleri - Kırmadan Su Kaçağı Tespiti";
        $activePage = 'home';
        
        require __DIR__ . '/../../resources/views/home.php';
    }

    public function book() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $serviceName = trim($_POST['service_name'] ?? 'Genel Tesisat Servisi');
            $address = trim($_POST['address'] ?? '');
            $notes = trim($_POST['notes'] ?? '');

            if ($name && $phone && $address) {
                Booking::create([
                    'name' => $name,
                    'phone' => $phone,
                    'service_name' => $serviceName,
                    'address' => $address,
                    'notes' => $notes
                ]);
                $_SESSION['flash_success'] = 'Randevu talebiniz başarıyla alındı! Ekiplerimiz en kısa sürede sizi arayacaktır.';
            } else {
                $_SESSION['flash_error'] = 'Lütfen Ad Soyad, Telefon ve Adres alanlarını doldurunuz.';
            }
            header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
            exit;
        }
    }
}
