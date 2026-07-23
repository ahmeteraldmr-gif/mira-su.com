<?php require __DIR__ . '/layouts/app.php'; ?>

<!-- Page Header Banner -->
<section class="page-header-banner page-header-services py-5">
    <div class="container py-4 text-center">
        <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fw-bold text-uppercase">Çözümlerimiz</span>
        <h1 class="display-4 fw-bold mt-2">Hizmetlerimiz & Çözüm Kataloğumuz</h1>
        <p class="lead text-secondary max-w-600 mx-auto">Profesyonel cihazlar ve uzman ekibimizle verdiğimiz tüm sıhhi tesisat & arıtma hizmetleri.</p>
    </div>
</section>

<!-- Services Grid Section -->
<section class="py-5 bg-light">
    <div class="container py-4">

        <!-- Category Filter Tabs -->
        <div class="d-flex justify-content-center flex-wrap gap-2 mb-5">
            <button class="btn btn-outline-primary active rounded-pill px-4 py-2 fw-bold service-filter-btn" data-filter="all">
                <i class="fa-solid fa-border-all me-1"></i> Tüm Hizmetlerimiz
            </button>
            <button class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold service-filter-btn" data-filter="kacak">
                <i class="fa-solid fa-magnifying-glass-location me-1"></i> Su Kaçağı
            </button>
            <button class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold service-filter-btn" data-filter="tikaniklik">
                <i class="fa-solid fa-screwdriver-wrench me-1"></i> Tıkanıklık Açma
            </button>
            <button class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold service-filter-btn" data-filter="aritma">
                <i class="fa-solid fa-filter me-1"></i> Su Arıtma & Kombi
            </button>
        </div>

        <div class="row g-4" id="servicesGrid">
            <?php foreach ($services as $service): 
                $cat = 'all';
                if (str_contains($service['slug'], 'kacag') || str_contains($service['slug'], 'tespiti')) $cat = 'kacak';
                elseif (str_contains($service['slug'], 'tikaniklik') || str_contains($service['slug'], 'kanal')) $cat = 'tikaniklik';
                elseif (str_contains($service['slug'], 'aritma') || str_contains($service['slug'], 'petek')) $cat = 'aritma';
            ?>
                <div class="col-lg-6 service-item" data-category="<?= $cat ?>">
                    <div class="feature-card d-flex flex-column flex-md-row gap-4 align-items-start h-100">
                        <div class="feature-icon flex-shrink-0 m-0" style="width:72px;height:72px;font-size:2rem;">
                            <i class="fa-solid <?= htmlspecialchars($service['icon']) ?>"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h4 class="fw-bold m-0 text-dark"><?= htmlspecialchars($service['title']) ?></h4>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill small fw-bold"><?= htmlspecialchars($service['price']) ?></span>
                            </div>
                            <p class="text-muted mb-4"><?= htmlspecialchars($service['description'] ?: $service['summary']) ?></p>
                            
                            <div class="d-flex flex-wrap align-items-center gap-3 pt-2 border-top">
                                <button class="btn btn-primary btn-sm rounded-pill px-4 py-2 fw-bold trigger-booking-modal" data-bs-toggle="modal" data-bs-target="#quickBookingModal" data-service-title="<?= htmlspecialchars($service['title']) ?>">
                                    <i class="fa-solid fa-calendar-plus me-1"></i> Servis Çağır
                                </button>
                                <a href="https://wa.me/<?= htmlspecialchars($settings['site_whatsapp'] ?? '905320000000') ?>?text=<?= urlencode('Merhaba, ' . $service['title'] . ' hakkında bilgi almak istiyorum.') ?>" target="_blank" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2 fw-bold">
                                    <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Banner Emergency Callout -->
        <div class="bg-primary text-white rounded-4 p-5 mt-5 shadow-lg text-center text-lg-start d-lg-flex align-items-center justify-content-between position-relative overflow-hidden">
            <div class="position-relative z-2">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2 text-uppercase"><i class="fa-solid fa-bolt"></i> 7/24 Mobil Acil Ekip</span>
                <h3 class="fw-bold text-white mb-2">Acil Su Baskını veya Boru Patlaması mı Var?</h3>
                <p class="mb-0 text-white-50 fs-5">Zaman kaybetmeden mobil servis ekibimize 7/24 doğrudan ulaşın!</p>
            </div>
            <div class="mt-4 mt-lg-0 position-relative z-2">
                <a href="tel:<?= preg_replace('/[^0-9]/', '', $settings['site_phone'] ?? '05320000000') ?>" class="btn btn-warning btn-lg rounded-pill px-5 py-3 fw-bold text-dark fs-5 shadow">
                    <i class="fa-solid fa-phone-volume me-2"></i> <?= htmlspecialchars($settings['site_phone'] ?? '0532 000 00 00') ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/layouts/footer.php'; ?>
