<?php

namespace App\Database;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $dbPath = __DIR__ . '/../../database/database.sqlite';
            $dbDir = dirname($dbPath);
            if (!file_exists($dbDir)) {
                mkdir($dbDir, 0777, true);
            }

            try {
                self::$instance = new PDO("sqlite:" . $dbPath);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                
                self::initSchema();
            } catch (PDOException $e) {
                die("Veritabanı bağlantı hatası: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    private static function initSchema(): void {
        $db = self::$instance;

        // Users table
        $db->exec("CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password_hash TEXT NOT NULL,
            name TEXT NOT NULL,
            role TEXT DEFAULT 'admin',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Services table
        $db->exec("CREATE TABLE IF NOT EXISTS services (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            slug TEXT UNIQUE NOT NULL,
            summary TEXT,
            description TEXT,
            icon TEXT,
            price TEXT,
            is_featured INTEGER DEFAULT 1,
            is_active INTEGER DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Bookings table
        $db->exec("CREATE TABLE IF NOT EXISTS bookings (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            phone TEXT NOT NULL,
            service_name TEXT NOT NULL,
            address TEXT NOT NULL,
            notes TEXT,
            status TEXT DEFAULT 'Bekliyor',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Contact Messages table
        $db->exec("CREATE TABLE IF NOT EXISTS contact_messages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT,
            phone TEXT NOT NULL,
            subject TEXT,
            message TEXT NOT NULL,
            is_read INTEGER DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        // Settings table
        $db->exec("CREATE TABLE IF NOT EXISTS settings (
            key TEXT PRIMARY KEY,
            value TEXT
        )");

        // Gallery Items table
        $db->exec("CREATE TABLE IF NOT EXISTS gallery_items (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            category TEXT DEFAULT 'kacak',
            image_url TEXT NOT NULL,
            description TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )");

        self::seedData();
    }

    private static function seedData(): void {
        $db = self::$instance;

        // Admin User (admin / password123)
        $userCount = $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
        if ($userCount == 0) {
            $stmt = $db->prepare("INSERT INTO users (username, password_hash, name, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                'admin',
                password_hash('password123', PASSWORD_DEFAULT),
                'Miraç Su Yönetici',
                'admin'
            ]);
        }

        // Default Services
        $serviceCount = $db->query("SELECT COUNT(*) FROM services")->fetchColumn();
        if ($serviceCount == 0) {
            $services = [
                [
                    'title' => 'Robotla Su Kaçağı Tespiti',
                    'slug' => 'robotla-su-kacagi-tespiti',
                    'summary' => 'Termal kamera ve akustik dinleme cihazları ile kırmadan dökmeden nokta atışı su kaçağı tespiti.',
                    'description' => 'Evinizde veya iş yerinizde fayansları kırmadan, duvarlara zarar vermeden son teknoloji Alman akustik dinleme ve termal görüntüleme ekipmanlarımızla gizli su kaçaklarını %100 kesinlikle tespit ediyoruz.',
                    'icon' => 'fa-magnifying-glass-location',
                    'price' => 'Sabit Fiyat Garantisi',
                    'is_featured' => 1
                ],
                [
                    'title' => 'Tıkanıklık Açma & Kanal Temizleme',
                    'slug' => 'tikaniklik-acma-kanal-temizleme',
                    'summary' => 'Mutfak, banyo, tuvalet ve lavabo tıkanıklıklarını kameralı robot sistemlerle anında açıyoruz.',
                    'description' => 'Mutfak gideri, tuvalet veya ana rögarlarda oluşan tıkanıklıkları yüksek basınçlı yıkama ve döner başlıklı robot yılan kameralarla kırmadan kısa sürede açıp temizliyoruz.',
                    'icon' => 'fa-screwdriver-wrench',
                    'price' => 'Uygun Fiyatlı Servis',
                    'is_featured' => 1
                ],
                [
                    'title' => 'Petek Temizliği & Kombi Bakımı',
                    'slug' => 'petek-temizligi-kombi-bakimi',
                    'summary' => 'Özel kimyasal ve çift yönlü tesisat yıkama makinesi ile ısınmayan petekleri temizliyoruz.',
                    'description' => 'Peteklerinizde biriken çamur, kireç ve korozyonu özel yıkama robotlarımız ve koruyucu ilaçlarla temizleyerek yakıt tasarrufunuzu %30 artırıyoruz.',
                    'icon' => 'fa-fire-flame-curved',
                    'price' => '%30 Yakıt Tasarrufu',
                    'is_featured' => 1
                ],
                [
                    'title' => 'Su Arıtma Montajı & Filtre Değişimi',
                    'slug' => 'su-aritma-montaji-filtre-degisimi',
                    'summary' => 'Alkalin PH değerli, 6 aşamalı pompalı evsel ve endüstriyel su arıtma sistemleri montajı.',
                    'description' => 'Musluğunuzdan güvenle ve lezzetle içebileceğiniz premium su arıtma sistemlerinin satışı, yerinde montajı, periyodik filtre değişimi ve bakımı yapılmaktadır.',
                    'icon' => 'fa-filter',
                    'price' => 'Orijinal Filtreler',
                    'is_featured' => 1
                ],
                [
                    'title' => '7/24 Acil Sıhhi Tesisat & Tamirat',
                    'slug' => 'acil-sahhi-tesisat-tamirat',
                    'summary' => 'Patlayan boru, vana arızası, batarya değişimi ve acil su baskınlarına 30 dakikada müdahale.',
                    'description' => 'Gece veya gündüz fark etmeksizin acil tesisat arızalarında uzman mobil ekibimiz 30 dakika içinde kapınızda olur. Tüm tamirat işleri 2 yıl garantilidir.',
                    'icon' => 'fa-clock-rotate-left',
                    'price' => '7/24 Hızlı Mobil Servis',
                    'is_featured' => 1
                ],
                [
                    'title' => 'Gömme Rezervuar & Vitrifiye Montajı',
                    'slug' => 'gomme-rezervuar-vitrifiye-montaji',
                    'summary' => 'Grohe, Geberit ve Serel gömme rezervuar tamiri, klozet ve batarya montaj hizmetleri.',
                    'description' => 'Su kaçıran gömme rezervuar iç takımlarının orijinal yedek parça ile tamiri, klozet, lavabo ve duş seti montaj uygulamalarımız estetik işçilikle yapılır.',
                    'icon' => 'fa-toilet',
                    'price' => 'Garantili İşçilik',
                    'is_featured' => 0
                ]
            ];

            $stmt = $db->prepare("INSERT INTO services (title, slug, summary, description, icon, price, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?)");
            foreach ($services as $s) {
                $stmt->execute([$s['title'], $s['slug'], $s['summary'], $s['description'], $s['icon'], $s['price'], $s['is_featured']]);
            }
        }

        // Default Gallery Items
        $galleryCount = $db->query("SELECT COUNT(*) FROM gallery_items")->fetchColumn();
        if ($galleryCount == 0) {
            $items = [
                ['title' => 'Akustik Dinleme ile Noktasal Kaçak Tespiti', 'category' => 'kacak', 'image_url' => '/images/gallery_real_1.jpg', 'description' => 'Frekans dinleme kulaklığı ve zemin sensörü ile kırmadan noktasal su kaçağı tespiti.'],
                ['title' => 'Kameralı Kanal & Gider İnceleme Robotu', 'category' => 'robot', 'image_url' => '/images/gallery_real_2.jpg', 'description' => 'Yüksek çözünürlüklü dijital ekranlı makara sistemi ile pimaş boru içi görüntüleme.'],
                ['title' => 'PowerMaxx Leak Detector Seti', 'category' => 'kacak', 'image_url' => '/images/gallery_real_3.jpg', 'description' => 'Özel taşıma çantasında akustik kulaklık ve frekans paneli ile sıfır hata tespiti.'],
                ['title' => 'Rothenberger ROSCAN i4000 Termal Kamera', 'category' => 'termal', 'image_url' => '/images/gallery_real_4.jpg', 'description' => 'Sıcak ve soğuk su hatlarındaki kaçakları duvar arkasından gösteren Alman termal kamerası.'],
                ['title' => 'Işıklı Boru İçi Görüntüleme Başlığı', 'category' => 'robot', 'image_url' => '/images/gallery_real_5.jpg', 'description' => 'Gider hatlarına gönderilen su geçirmez LED aydınlatmalı kamera robota ait başlık.']
            ];
            $stmt = $db->prepare("INSERT INTO gallery_items (title, category, image_url, description) VALUES (?, ?, ?, ?)");
            foreach ($items as $item) {
                $stmt->execute([$item['title'], $item['category'], $item['image_url'], $item['description']]);
            }
        }

        // Default Settings
        $settingCount = $db->query("SELECT COUNT(*) FROM settings")->fetchColumn();
        if ($settingCount == 0) {
            $settings = [
                'site_name' => 'Miraç Su Tesisatı & Arıtma Sistemleri',
                'site_phone' => '0532 000 00 00',
                'site_whatsapp' => '905320000000',
                'site_emergency' => '0850 000 00 00',
                'site_email' => 'info@miracsu.com',
                'site_address' => 'Merkez Mahallesi, Tesisatçılar Cad. No:45 Ada / İstanbul',
                'working_hours' => '7 Gün 24 Saat Acil Servis Hizmeti',
                'about_story' => 'Miraç Su Tesisatı & Arıtma Sistemleri, Ada ve çevre bölgelerde sıhhi tesisat sektörünün eksikliklerini ve müşteri mağduriyetlerini gidermek amacıyla kurulmuştur. Evlerde kırmadan dökmeden arıza tespiti yapabilen Alman üretimi teknolojik ekipman yatırımımız ile bölgenin lider tesisat firması haline geldik.',
                'about_mission' => 'Teknolojik cihazlarla kırmadan %100 kesin çözümler sunarak müşteri memnuniyetini en üst seviyede tutmak.',
                'about_vision' => 'Bölgenin en güvenilir, en hızlı ve yenilikçi su tesisatı & arıtma markası konumunu sürdürmek.',
                'facebook_url' => 'https://facebook.com',
                'instagram_url' => 'https://instagram.com'
            ];

            $stmt = $db->prepare("INSERT INTO settings (key, value) VALUES (?, ?)");
            foreach ($settings as $k => $v) {
                $stmt->execute([$k, $v]);
            }
        }
    }
}
