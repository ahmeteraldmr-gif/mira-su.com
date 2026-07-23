<?php require __DIR__ . '/layouts/app.php'; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg-shapes"></div>
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="hero-badge">
                    <i class="fa-solid fa-certificate"></i> 7/24 Kırmadan Robotlu Tesisat Servisi
                </div>
                <h1 class="hero-title">
                    Kırmadan Dökmeden <br>
                    <span>Su Kaçağı Tespiti</span> & Tesisat Çözümleri
                </h1>
                <p class="hero-lead">
                    Miraç Su olarak Ada ve çevresinde son teknoloji termal kameralar, akustik dinleme cihazları ve profesyonel ekibimizle evinizi kırmadan noktasal su kaçağı tespiti ve tamiri yapıyoruz.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <button class="btn btn-primary btn-lg rounded-pill px-4 py-3 fw-bold trigger-booking-modal" data-bs-toggle="modal" data-bs-target="#quickBookingModal">
                        <i class="fa-solid fa-calendar-check me-2"></i> Hemen Randevu Al
                    </button>
                    <a href="tel:<?= preg_replace('/[^0-9]/', '', $settings['site_phone'] ?? '05320000000') ?>" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fw-bold">
                        <i class="fa-solid fa-phone-volume text-info me-2"></i> 7/24 Acil Servis
                    </a>
                </div>

                <div class="row g-3 mt-4 pt-3 border-top border-secondary">
                    <div class="col-sm-4">
                        <div class="d-flex align-items-center gap-2 text-light">
                            <i class="fa-solid fa-shield-halved text-info fs-4"></i>
                            <div>
                                <div class="fw-bold">%100 Garantili</div>
                                <div class="small text-muted">Kırmadan Tespit</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d-flex align-items-center gap-2 text-light">
                            <i class="fa-solid fa-stopwatch text-info fs-4"></i>
                            <div>
                                <div class="fw-bold">30 Dk Kapınızda</div>
                                <div class="small text-muted">Hızlı Mobil Ekip</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="d-flex align-items-center gap-2 text-light">
                            <i class="fa-solid fa-hand-holding-dollar text-info fs-4"></i>
                            <div>
                                <div class="fw-bold">Sabit Fiyat</div>
                                <div class="small text-muted">Sürpriz Ücret Yok</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="position-relative">
                    <img src="/images/hero.png" alt="Miraç Su Tesisatı" class="img-fluid shadow-lg border border-secondary" style="width: 100%; height: 520px; object-fit: cover; border-radius: 24px;">
                    <div class="glass-card position-absolute bottom-0 start-0 m-3 p-3 text-white d-none d-sm-flex align-items-center gap-3">
                        <i class="fa-solid fa-circle-check text-success fs-1"></i>
                        <div>
                            <h6 class="mb-0 fw-bold">Uzman Sertifikalı Kadro</h6>
                            <small class="text-light">5,800+ Başarılı Tesisat Müdahalesi</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features / Statistics Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-6">
                <div class="stat-box">
                    <div class="stat-number">15+</div>
                    <div class="stat-label">Yıllık Tecrübe</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-box">
                    <div class="stat-number">5.8K+</div>
                    <div class="stat-label">Mutlu Müşteri</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-box">
                    <div class="stat-number">30 Dk</div>
                    <div class="stat-label">Ortalama Servis Süresi</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-box">
                    <div class="stat-number">%100</div>
                    <div class="stat-label">Garanti & Memnuniyet</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Showcase -->
<section class="py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-bold text-uppercase">Hizmetlerimiz</span>
            <h2 class="display-5 fw-bold text-dark mt-2">Nokta Atışı Tesisat Çözümleri</h2>
            <p class="text-muted fs-5">Son teknoloji robotik cihazlarımız ile tüm sıhhi tesisat ihtiyaçlarınızda yanınızdayız.</p>
        </div>

        <div class="row g-4">
            <?php foreach ($services as $service): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card d-flex flex-column">
                        <div class="feature-icon">
                            <i class="fa-solid <?= htmlspecialchars($service['icon']) ?>"></i>
                        </div>
                        <h4 class="fw-bold mb-3"><?= htmlspecialchars($service['title']) ?></h4>
                        <p class="text-muted mb-4 flex-grow-1"><?= htmlspecialchars($service['summary']) ?></p>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <span class="badge bg-light text-primary border fw-bold px-3 py-2"><?= htmlspecialchars($service['price']) ?></span>
                            <button class="btn btn-outline-primary btn-sm rounded-pill px-3 trigger-booking-modal" data-bs-toggle="modal" data-bs-target="#quickBookingModal" data-service-title="<?= htmlspecialchars($service['title']) ?>">
                                <i class="fa-solid fa-arrow-right"></i> Servis İste
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us & Visual Banner -->
<section class="py-5 bg-dark text-white position-relative">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="/images/leak_detect.png" alt="Termal Kamera Su Kaçağı" class="img-fluid rounded-4 shadow border border-secondary">
            </div>
            <div class="col-lg-6">
                <span class="text-info fw-bold text-uppercase">Neden Miraç Su Tesisatı?</span>
                <h2 class="display-6 fw-bold mt-2 mb-4">Noktasal Kaçak Tespiti ile Evinizi Harabeye Çevirmeyin!</h2>
                <p class="text-secondary fs-5 mb-4">
                    Eski usül kırarak arıza arama devri bitti! Miraç Su olarak termal kameralı ve frekans dinleme cihazlı robotlarımız sayesinde kaçağı santimetre hassasiyetinde tespit ediyoruz.
                </p>

                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-start gap-3">
                        <div class="bg-primary text-white rounded-circle p-2 mt-1"><i class="fa-solid fa-check"></i></div>
                        <div>
                            <h5 class="mb-1 text-white">Gereksiz Kırım Yapılmaz</h5>
                            <p class="text-secondary small">Sadece arızanın bulunduğu tek bir fayans yerinden çıkarılır, boş yere eviniz kirlenmez.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <div class="bg-primary text-white rounded-circle p-2 mt-1"><i class="fa-solid fa-check"></i></div>
                        <div>
                            <h5 class="mb-1 text-white">Yazılı İşçilik Garantisi</h5>
                            <p class="text-secondary small">Yapılan tüm tamir, değişim ve tıkanıklık açma işlemleri garanti belgesi ile teslim edilir.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-3">
                        <div class="bg-primary text-white rounded-circle p-2 mt-1"><i class="fa-solid fa-check"></i></div>
                        <div>
                            <h5 class="mb-1 text-white">Uygun ve Şeffaf Fiyatlandırma</h5>
                            <p class="text-secondary small">İş başlamadan önce net fiyat belirtilir, onayınız olmadan ekstra maliyet çıkarılmaz.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Customer Reviews Section -->
<section class="py-5 bg-light">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold text-uppercase">Müşteri Yorumları</span>
            <h2 class="display-6 fw-bold text-dark mt-2">Müşterilerimiz Ne Diyor?</h2>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <div class="text-warning mb-3">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="card-text text-muted">"Gece 2'de banyoda alt komşuya su sızıyordu. Miraç Su ekibi yarım saatte geldi. Termal kamerayla noktayı bulup tek fayans kırarak hallettiler. Muazzam hizmet!"</p>
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <div class="bg-primary text-white rounded-circle fw-bold d-flex align-items-center justify-content-center" style="width:45px;height:45px;">MK</div>
                        <div>
                            <h6 class="mb-0 fw-bold">Murat Kaya</h6>
                            <small class="text-muted">Ada Sakini</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <div class="text-warning mb-3">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="card-text text-muted">"Mutfak giderimiz sürekli tıkanıyordu. Robot kamerayla bağlandılar, boru içindeki kireç birikintisini tamamen temizlediler. 1 yıldır tıkır tıkır çalışıyor."</p>
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <div class="bg-info text-white rounded-circle fw-bold d-flex align-items-center justify-content-center" style="width:45px;height:45px;">SD</div>
                        <div>
                            <h6 class="mb-0 fw-bold">Selin Demir</h6>
                            <small class="text-muted">Ev Hanımı</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 h-100">
                    <div class="text-warning mb-3">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="card-text text-muted">"Evimize 6 aşamalı su arıtma cihazı bağlattık. Suyun tadı harika oldu, hazır su taşımaktan kurtulduk. İşçilik ve ilgi için teşekkürler."</p>
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <div class="bg-success text-white rounded-circle fw-bold d-flex align-items-center justify-content-center" style="width:45px;height:45px;">EA</div>
                        <div>
                            <h6 class="mb-0 fw-bold">Emre Arslan</h6>
                            <small class="text-muted">İşletme Sahibi</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/layouts/footer.php'; ?>
