<?php

namespace App\Controllers;

use App\Models\Setting;

class AboutController {
    public function index() {
        $settings = Setting::getAll();
        $title = "Hakkımızda - Miraç Su Tesisatı & Arıtma Sistemleri";
        $activePage = 'about';

        require __DIR__ . '/../../resources/views/about.php';
    }
}
