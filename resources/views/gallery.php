<?php require __DIR__ . '/layouts/app.php'; ?>

<!-- Page Header Banner -->
<section class="page-header-banner page-header-gallery py-5">
    <div class="container py-4 text-center">
        <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fw-bold text-uppercase">Görsel Kataloğumuz</span>
        <h1 class="display-4 fw-bold mt-2">Profesyonel Ekipman & Saha Galerimiz</h1>
        <p class="lead text-secondary max-w-600 mx-auto">Saha çalışmalarımızda kullandığımız 1. sınıf Alman ve teknolojik su kaçağı tespit cihazlarımız.</p>
    </div>
</section>

<!-- Gallery Filter & Grid Section -->
<section class="py-5 bg-white">
    <div class="container py-4">
        
        <!-- Filter Tabs -->
        <div class="d-flex justify-content-center flex-wrap gap-2 mb-5">
            <button class="btn btn-outline-primary active rounded-pill px-4 py-2 fw-bold filter-btn" data-filter="all">
                <i class="fa-solid fa-border-all me-1"></i> Tüm Fotoğraflar
            </button>
            <button class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold filter-btn" data-filter="kacak">
                <i class="fa-solid fa-volume-high me-1"></i> Akustik Kaçak
            </button>
            <button class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold filter-btn" data-filter="robot">
                <i class="fa-solid fa-video me-1"></i> Kameralı Robotlar
            </button>
            <button class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold filter-btn" data-filter="termal">
                <i class="fa-solid fa-fire-flame-simple me-1"></i> Termal Kamera
            </button>
        </div>

        <!-- Gallery Grid -->
        <div class="row g-4 justify-content-center" id="galleryGrid">
            
            <?php if (empty($galleryItems)): ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Galeride henüz fotoğraf eklenmemiş.</p>
                </div>
            <?php else: ?>
                <?php foreach ($galleryItems as $item): 
                    $badgeClass = $item['category'] === 'kacak' ? 'bg-danger' : ($item['category'] === 'robot' ? 'bg-info text-dark' : 'bg-warning text-dark');
                    $badgeText = $item['category'] === 'kacak' ? 'Akustik Kaçak' : ($item['category'] === 'robot' ? 'Kameralı Robot' : 'Termal Kamera');
                ?>
                    <div class="col-lg-4 col-md-6 gallery-item" data-category="<?= htmlspecialchars($item['category']) ?>">
                        <div class="gallery-card shadow-sm rounded-4 overflow-hidden position-relative bg-dark">
                            <img src="<?= asset($item['image_url']) ?>" class="gallery-img" alt="<?= htmlspecialchars($item['title']) ?>">
                            <div class="gallery-overlay">
                                <span class="badge <?= $badgeClass ?> mb-2"><?= $badgeText ?></span>
                                <h5 class="fw-bold text-white mb-1"><?= htmlspecialchars($item['title']) ?></h5>
                                <p class="small text-light opacity-75 mb-3"><?= htmlspecialchars($item['description']) ?></p>
                                <button class="btn btn-light btn-sm rounded-pill fw-bold open-lightbox" data-img="<?= asset($item['image_url']) ?>" data-title="<?= htmlspecialchars($item['title']) ?>" data-desc="<?= htmlspecialchars($item['description']) ?>">
                                    <i class="fa-solid fa-magnifying-glass-plus me-1"></i> Tam Ekran Gör
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>

        <!-- Technical Equipment Spec Banner -->
        <div class="mt-5 p-4 p-md-5 bg-dark text-white rounded-4 shadow border border-secondary">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fw-bold text-uppercase mb-2">Teknolojik Parkurumuz</span>
                    <h3 class="fw-bold text-white">Neden Kırmadan Tespit Yapabiliyoruz?</h3>
                    <p class="text-slate-300 m-0">
                        Bünyemizde bulunan **Rothenberger ROSCAN i4000** termal kameralar, **PowerMaxx 0-100Hz** frekans dinleme cihazları ve **AHD HD Kameralı Pimaş Robotlarımız** sayesinde kırım yapmadan sorunun kaynağına 30 dakikada ulaşıyoruz.
                    </p>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <button class="btn btn-warning btn-lg rounded-pill px-4 fw-bold trigger-booking-modal" data-bs-toggle="modal" data-bs-target="#quickBookingModal">
                        <i class="fa-solid fa-phone-volume me-2"></i> Ekip Çağır
                    </button>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Lightbox Modal -->
<div class="modal fade" id="lightboxModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark text-white border-secondary rounded-4 overflow-hidden">
            <div class="modal-header border-secondary">
                <h5 class="modal-title fw-bold" id="lightboxTitle">Fotoğraf İnceleme</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-0 bg-black">
                <img src="" id="lightboxImg" class="img-fluid" style="max-height: 75vh; object-fit: contain;" alt="Cihaz Görseli">
            </div>
            <div class="modal-footer border-secondary justify-content-between">
                <p class="text-slate-300 small m-0 text-start" id="lightboxDesc"></p>
                <button type="button" class="btn btn-outline-light btn-sm rounded-pill" data-bs-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/layouts/footer.php'; ?>
