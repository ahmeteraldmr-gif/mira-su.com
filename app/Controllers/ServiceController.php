<?php

namespace App\Controllers;

use App\Models\Service;
use App\Models\Setting;

class ServiceController {
    public function index() {
        $services = Service::getActive();
        $settings = Setting::getAll();
        $title = "Hizmetlerimiz - Miraç Su Tesisatı & Arıtma Sistemleri";
        $activePage = 'services';

        require __DIR__ . '/../../resources/views/services.php';
    }
}
