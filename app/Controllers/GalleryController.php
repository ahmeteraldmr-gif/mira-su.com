<?php

namespace App\Controllers;

use App\Models\Setting;
use App\Models\GalleryItem;

class GalleryController {
    public function index() {
        $settings = Setting::getAll();
        $galleryItems = GalleryItem::getAll();
        $title = "Galeri & Projelerimiz - Miraç Su Tesisatı";
        $activePage = 'gallery';

        require __DIR__ . '/../../resources/views/gallery.php';
    }
}
