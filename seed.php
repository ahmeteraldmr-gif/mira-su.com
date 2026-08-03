<?php

// Standalone CLI Database & Seed Test Script for Miraç Su Tesisatı

$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($name, $val) = explode('=', $line, 2);
            $name = trim($name);
            $val = trim($val, " \"'");
            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv("$name=$val");
                $_ENV[$name] = $val;
                $_SERVER[$name] = $val;
            }
        }
    }
}

if (!function_exists('env')) {
    function env(string $key, $default = null) {
        $value = getenv($key);
        if ($value === false) return $default;
        return $value;
    }
}

require_once __DIR__ . '/vendor/autoload.php';

echo "\n=======================================================\n";
echo "  MİRAÇ SU TESİSATI - VERİTABANI VE SEED KONTROLÜ\n";
echo "=======================================================\n\n";

try {
    $db = \App\Database\Database::getConnection();
    echo "[ BAŞARILI ] Veritabanına başarıyla bağlanıldı!\n\n";

    $tables = ['users', 'services', 'bookings', 'gallery_items', 'contact_messages', 'settings'];
    foreach ($tables as $t) {
        $count = $db->query("SELECT COUNT(*) FROM {$t}")->fetchColumn();
        echo "  - Tablo '{$t}': {$count} kayıt mevcut.\n";
    }

    echo "\n-------------------------------------------------------\n";
    echo "[ BAŞARILI ] Tüm veritabanı tabloları ve örnek veriler hazır!\n";
    echo "=======================================================\n\n";
} catch (\Throwable $e) {
    echo "[ HATA ] Veritabanı bağlantı hatası alındı:\n";
    echo $e->getMessage() . "\n\n";
}
