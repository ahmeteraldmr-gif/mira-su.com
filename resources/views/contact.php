<?php require __DIR__ . '/layouts/app.php'; ?>

<!-- Page Header Banner -->
<section class="page-header-banner page-header-contact py-5">
    <div class="container py-4 text-center">
        <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fw-bold text-uppercase">Ulaşın</span>
        <h1 class="display-4 fw-bold mt-2">İletişim & Konum</h1>
        <p class="lead text-secondary max-w-600 mx-auto">7/24 Çağrı merkezimiz, WhatsApp destek hattımız veya iletişim formumuz üzerinden bize ulaşabilirsiniz.</p>
    </div>
</section>

<!-- Contact Form & Info Cards -->
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="feature-card text-center h-100">
                    <div class="feature-icon mx-auto mb-3" style="width:64px;height:64px;font-size:1.7rem;">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Telefon / Çağrı Merkezi</h5>
                    <p class="text-muted small mb-3">7/24 Kesintisiz Acil Çağrı</p>
                    <a href="tel:<?= preg_replace('/[^0-9]/', '', $settings['site_phone'] ?? '05320000000') ?>" class="btn btn-outline-primary rounded-pill fw-bold px-3 py-2 w-100"><?= htmlspecialchars($settings['site_phone'] ?? '0532 000 00 00') ?></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card text-center h-100">
                    <div class="feature-icon mx-auto mb-3 bg-success-subtle text-success" style="width:64px;height:64px;font-size:1.7rem;">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">WhatsApp Destek</h5>
                    <p class="text-muted small mb-3">Konum Gönderin, Anında Gelelim</p>
                    <a href="https://wa.me/<?= htmlspecialchars($settings['site_whatsapp'] ?? '905320000000') ?>" target="_blank" class="btn btn-outline-success rounded-pill fw-bold px-3 py-2 w-100">+<?= htmlspecialchars($settings['site_whatsapp'] ?? '905320000000') ?></a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="feature-card text-center h-100">
                    <div class="feature-icon mx-auto mb-3 bg-warning-subtle text-warning-emphasis" style="width:64px;height:64px;font-size:1.7rem;">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Servis Adresimiz</h5>
                    <p class="text-muted small mb-0"><?= htmlspecialchars($settings['site_address'] ?? 'Merkez Mah. Tesisatçılar Cad. No:45 Ada / İstanbul') ?></p>
                </div>
            </div>
        </div>

        <div class="row g-5 align-items-stretch">
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white h-100">
                    <h3 class="fw-bold text-dark mb-1"><i class="fa-solid fa-paper-plane text-primary me-2"></i> Bize Mesaj Gönderin</h3>
                    <p class="text-muted small mb-4">Soru, görüş veya fiyat teklifi talepleriniz için aşağıdaki formu doldurabilirsiniz.</p>

                    <form action="/iletisim/gonder" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-secondary">Adınız Soyadınız *</label>
                                <input type="text" name="name" class="form-control form-control-lg fs-6" placeholder="Ad Soyad" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-secondary">Telefon Numaranız *</label>
                                <input type="tel" name="phone" class="form-control form-control-lg fs-6" placeholder="05XX XXX XX XX" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-secondary">E-Posta Adresiniz</label>
                                <input type="email" name="email" class="form-control form-control-lg fs-6" placeholder="ornek@domain.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-secondary">Konu</label>
                                <input type="text" name="subject" class="form-control form-control-lg fs-6" placeholder="Örn: Fiyat Teklifi / Bilgi">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold text-secondary">Mesajınız *</label>
                                <textarea name="message" class="form-control fs-6" rows="4" placeholder="Mesajınızı detaylı şekilde yazabilirsiniz..." required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold w-100">
                                    <i class="fa-solid fa-paper-plane me-2"></i> Mesajı Gönder
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Map / Visual Card -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                    <div class="card-body p-4 p-md-5 d-flex flex-column justify-content-between">
                        <div>
                            <h4 class="fw-bold mb-3"><i class="fa-solid fa-map-location-dot text-info me-2"></i> Hızlı Servis Bölgesi</h4>
                            <p class="text-muted">
                                Mobil ekiplerimiz Ada genelinde her mahalleye ve sokak aralarına 30 dakika erişim garantisi sunar.
                            </p>
                            <hr class="my-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="fa-solid fa-clock text-primary fs-4"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold">Çalışma Saatleri</h6>
                                    <small class="text-muted"><?= htmlspecialchars($settings['working_hours'] ?? '7 Gün 24 Saat Açık') ?></small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="fa-solid fa-envelope text-primary fs-4"></i>
                                <div>
                                    <h6 class="mb-0 fw-bold">E-Posta Adresi</h6>
                                    <small class="text-muted"><?= htmlspecialchars($settings['site_email'] ?? 'info@miracsu.com') ?></small>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 bg-light rounded-3 text-center border mt-4">
                            <i class="fa-solid fa-headset text-primary display-4 mb-2"></i>
                            <h6 class="fw-bold mb-1">Müşteri Destek Hattı</h6>
                            <p class="small text-muted mb-0">Teknik ekibimiz telefonun ucunda bekliyor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/layouts/footer.php'; ?>
