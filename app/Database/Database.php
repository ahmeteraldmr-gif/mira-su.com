<?php

namespace App\Database;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $connection = env('DB_CONNECTION', 'mysql');

            try {
                if ($connection === 'mysql') {
                    $host = env('DB_HOST', '127.0.0.1');
                    $port = env('DB_PORT', '3306');
                    $dbname = env('DB_DATABASE', 'miracsutesisat_tesisat');
                    $username = env('DB_USERNAME', 'miracsutesisat_admin');
                    $password = env('DB_PASSWORD', '');

                    $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
                    self::$instance = new PDO($dsn, $username, $password);
                } else {
                    $dbPath = __DIR__ . '/../../database/database.sqlite';
                    $dbDir = dirname($dbPath);
                    if (!file_exists($dbDir)) {
                        mkdir($dbDir, 0777, true);
                    }
                    self::$instance = new PDO("sqlite:" . $dbPath);
                }

                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                self::initSchema($connection);
            } catch (PDOException $e) {
                die("Veritabanı bağlantı hatası: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    private static function initSchema(string $connection): void {
        $db = self::$instance;

        if ($connection === 'mysql') {
            $pk = "INT AUTO_INCREMENT PRIMARY KEY";
            $dt = "TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
        } else {
            $pk = "INTEGER PRIMARY KEY AUTOINCREMENT";
            $dt = "DATETIME DEFAULT CURRENT_TIMESTAMP";
        }

        // Users table
        $db->exec("CREATE TABLE IF NOT EXISTS users (
            id {$pk},
            username VARCHAR(191) UNIQUE NOT NULL,
            password_hash VARCHAR(255) NOT NULL,
            name VARCHAR(191) NOT NULL,
            role VARCHAR(50) DEFAULT 'admin',
            created_at {$dt}
        )");

        // Services table
        $db->exec("CREATE TABLE IF NOT EXISTS services (
            id {$pk},
            title VARCHAR(191) NOT NULL,
            slug VARCHAR(191) UNIQUE NOT NULL,
            summary TEXT,
            description TEXT,
            icon VARCHAR(191),
            price VARCHAR(191),
            is_featured INT DEFAULT 1,
            is_active INT DEFAULT 1,
            created_at {$dt}
        )");

        // Bookings table
        $db->exec("CREATE TABLE IF NOT EXISTS bookings (
            id {$pk},
            name VARCHAR(191) NOT NULL,
            phone VARCHAR(191) NOT NULL,
            service_name VARCHAR(191),
            address TEXT,
            notes TEXT,
            status VARCHAR(50) DEFAULT 'Bekliyor',
            created_at {$dt}
        )");

        // Gallery table
        $db->exec("CREATE TABLE IF NOT EXISTS gallery_items (
            id {$pk},
            title VARCHAR(191) NOT NULL,
            category VARCHAR(50) NOT NULL,
            image_url VARCHAR(255) NOT NULL,
            description TEXT,
            created_at {$dt}
        )");

        // Messages table
        $db->exec("CREATE TABLE IF NOT EXISTS contact_messages (
            id {$pk},
            name VARCHAR(191) NOT NULL,
            phone VARCHAR(191) NOT NULL,
            email VARCHAR(191),
            subject VARCHAR(191),
            message TEXT,
            is_read INT DEFAULT 0,
            created_at {$dt}
        )");

        // Settings table
        $db->exec("CREATE TABLE IF NOT EXISTS settings (
            id {$pk},
            setting_key VARCHAR(191) UNIQUE NOT NULL,
            setting_value TEXT,
            updated_at {$dt}
        )");

        self::seedDefaults();
    }

    private static function seedDefaults(): void {
        $db = self::$instance;

        // Check if admin user exists
        $stmt = $db->query("SELECT COUNT(*) FROM users");
        if ((int)$stmt->fetchColumn() === 0) {
            $stmt = $db->prepare("INSERT INTO users (username, password_hash, name, role) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                'admin',
                password_hash('password123', PASSWORD_DEFAULT),
                'Miraç Su Yönetici',
                'admin'
            ]);
        }

        // Check if services exist
        $stmt = $db->query("SELECT COUNT(*) FROM services");
        if ((int)$stmt->fetchColumn() === 0) {
            $services = [
                ['Kırmadan Robotla Su Kaçağı Tespiti', 'kırmadan-robotla-su-kacagi-tespiti', 'Termal kamera ve akustik dinleme cihazları ile kırmadan noktasal su kaçağı bulma.', 'Evinizde veya iş yerinizde fayans kırmadan, duvar bozmadan son teknoloji altyapı cihazlarımızla nokta atışı su kaçağı tespiti yapıyoruz.', 'fa-video', '500 TL\'den başlayan fiyatlarla'],
                ['Kameralı Robotla Tıkanıklık Açma', 'kamerali-robotla-tikaniklik-acma', 'Pimaş, lavabo, tuvalet ve kanal tıkanıklıklarını kameralı robot ile açma.', 'Tıkanan gider hatlarınızı özel çelik yaylı ve HD kameralı robot sistemimizle kırmadan 15 dakikada temizleyip açıyoruz.', 'fa-bore-hole', '400 TL\'den başlayan fiyatlarla'],
                ['Petek & Kombi Tesisat Temizliği', 'petek-kombi-tesisat-temizligi', 'Özel ilaçlı yıkama makineleri ile %30 yakıt tasarruflu petek temizliği.', 'Isınmayan radyatör ve çamurlanan kombi tesisatlarınızı basınçlı ilaçlı makinelerimizle yıkayarak ilk günkü verimine kavuşturuyoruz.', 'fa-fire-flame-curved', '450 TL\'den başlayan fiyatlarla'],
                ['Su Arıtma Cihazı Montajı & Bakımı', 'su-aritma-cihazi-montaji-bakimi', 'Evsel ve endüstriyel su arıtma filtre değişimi, bakım ve sıfır kurulum hizmetleri.', 'Sağlıklı ve lezzetli içme suyu için en kaliteli 5 aşamalı filtre değişimi ve arıtma cihazı montaj servisimiz 7/24 hizmetinizde.', 'fa-filter', '350 TL\'den başlayan fiyatlarla'],
                ['7/24 Acil Sıhhi Tesisat Tamiratı', '724-acil-sihhi-tesisat-tamirati', 'Musluk, batarya, vana, sifon tamiri ve acil patlayan boru müdahaleleri.', 'Gece gündüz demeden 30 dakikada adresinizde olan acil mobil servis aracımızla tüm sıhhi tesisat arızalarına müdahale ediyoruz.', 'fa-wrench', 'Teklif Alınız']
            ];

            $stmt = $db->prepare("INSERT INTO services (title, slug, summary, description, icon, price) VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($services as $s) {
                $stmt->execute($s);
            }
        }

        // Check if gallery items exist
        $stmt = $db->query("SELECT COUNT(*) FROM gallery_items");
        if ((int)$stmt->fetchColumn() === 0) {
            $gallery = [
                ['Işıklı Boru İçi Görüntüleme Başlığı', 'robot', '/images/gallery_real_1.jpg', 'Gider hatlarına gönderilen su geçirmez LED aydınlatmalı kamera robota ait başlık.'],
                ['Rothenberger ROSCAN i4000 Termal Kamera', 'termal', '/images/gallery_real_2.jpg', 'Sıcak ve soğuk su hatlarındaki kaçakları duvar arkasından gösteren Alman termal kamerası.'],
                ['PowerMaxx Leak Detector Seti', 'kacak', '/images/gallery_real_3.jpg', 'Özel taşıma çantasında akustik kulaklık ve frekans paneli ile sıfır hata tespiti.'],
                ['Kameralı Kanal & Gider İnceleme Robotu', 'robot', '/images/gallery_real_4.jpg', 'Tıkanıklığın tam yerini ve kırık boruları ekranda canlı gösteren tespit robotumuz.'],
                ['Akustik Dinleme ile Noktasal Kaçak Tespiti', 'kacak', '/images/gallery_real_5.jpg', 'Zemin altındaki sızıntı seslerini yükselterek 1 santim yanılma olmadan kaçak tespiti.']
            ];

            $stmt = $db->prepare("INSERT INTO gallery_items (title, category, image_url, description) VALUES (?, ?, ?, ?)");
            foreach ($gallery as $g) {
                $stmt->execute($g);
            }
        }

        // Check if settings exist
        $stmt = $db->query("SELECT COUNT(*) FROM settings");
        if ((int)$stmt->fetchColumn() === 0) {
            $settings = [
                'site_name' => 'Miraç Su Tesisatı & Arıtma Sistemleri',
                'site_phone' => '0532 000 00 00',
                'site_whatsapp' => '905320000000',
                'site_emergency' => '0532 000 00 00',
                'site_email' => 'info@miracsutesisat.com',
                'site_address' => 'Ada / İstanbul ve Tüm Çevre İlçeleri',
                'working_hours' => '7/24 Kesintisiz Mobil Servis Hizmeti',
                'about_story' => 'Miraç Su Tesisatı & Arıtma Sistemleri olarak 15 yılı aşkın süredir son teknoloji termal kameralar, akustik dinleme cihazları ve robotik kanal açma sistemlerimizle hizmet vermekteyiz.',
                'about_mission' => 'Müşterilerimize ev ve iş yerlerinde hiçbir yeri kırmadan dökmeden en ekonomik ve %100 garantili tesisat çözümleri sunmak.',
                'about_vision' => 'Bölgemizin en güvenilir, teknolojik ve hızlı acil tesisat servisi olmaya devam etmek.',
                'facebook_url' => 'https://facebook.com',
                'instagram_url' => 'https://instagram.com'
            ];

            $stmt = $db->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?)");
            foreach ($settings as $k => $v) {
                $stmt->execute([$k, $v]);
            }
        }
    }
}
