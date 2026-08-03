<?php

/**
 * CLI Database Seed & Connection Tester for Miraç Su Tesisatı
 */

require_once __DIR__ . '/public/index.php';

echo "\n=======================================================\n";
echo "  MİRAÇ SU TESİSATI - VERİTABANI VE SEED KONTROLÜ\n";
echo "=======================================================\n\n";

try {
    $db = \App\Database\Database::getConnection();
    echo "[ BAŞARILI ] Veritabanına başarıyla bağlanıldı!\n\n";

    // Test tables
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
