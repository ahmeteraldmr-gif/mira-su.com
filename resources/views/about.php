<?php require __DIR__ . '/layouts/app.php'; ?>

<!-- Page Header Banner -->
<section class="page-header-banner page-header-about py-5">
    <div class="container py-4 text-center">
        <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fw-bold text-uppercase">Biz Kimiz?</span>
        <h1 class="display-4 fw-bold mt-2">Hakkımızda</h1>
        <p class="lead text-secondary max-w-600 mx-auto">15 yılı aşkın tecrübe, teknolojik donanım ve kesintisiz güven ilkesiyle hizmetinizdeyiz.</p>
    </div>
</section>

<!-- Main About Content -->
<section class="py-5 bg-white">
    <div class="container py-4">
        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-6">
                <span class="text-primary fw-bold text-uppercase">Miraç Su Tesisatı Hikayesi</span>
                <h2 class="display-6 fw-bold text-dark mt-2 mb-4">Geleneksel Ustalığı Teknolojik Robotik Sistemlerle Buluşturduk</h2>
                <p class="text-muted fs-5">
                    <?= htmlspecialchars($settings['about_story'] ?? 'Miraç Su Tesisatı & Arıtma Sistemleri, Ada ve çevre bölgelerde sıhhi tesisat sektörünün eksikliklerini ve müşteri mağduriyetlerini gidermek amacıyla kurulmuştur. Evlerde kırmadan dökmeden arıza tespiti yapabilen Alman üretimi teknolojik ekipman yatırımımız ile bölgenin lider tesisat firması haline geldik.') ?>
                </p>

                <div class="row g-4 mt-3">
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
                            <h4 class="fw-bold text-primary mb-1">Misyonumuz</h4>
                            <p class="small text-muted mb-0"><?= htmlspecialchars($settings['about_mission'] ?? 'Teknolojik cihazlarla kırmadan %100 kesin çözümler sunarak müşteri memnuniyetini en üst seviyede tutmak.') ?></p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded-3 border-start border-4 border-info">
                            <h4 class="fw-bold text-info mb-1">Vizyonumuz</h4>
                            <p class="small text-muted mb-0"><?= htmlspecialchars($settings['about_vision'] ?? 'Bölgenin en güvenilir, en hızlı ve yenilikçi su tesisatı & arıtma markası konumunu sürdürmek.') ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="/images/water_filter.png" alt="Su Arıtma Montajı ve Tesisat" class="img-fluid rounded-4 shadow-lg">
            </div>
        </div>

        <!-- Values Grid -->
        <div class="row g-4 text-center mt-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 bg-light p-4 rounded-4">
                    <div class="fs-1 text-primary mb-3"><i class="fa-solid fa-microscope"></i></div>
                    <h5 class="fw-bold">Son Teknoloji Ekipman</h5>
                    <p class="text-muted small mb-0">Termal kameralar, akustik dinleme cihazları ve yüksek basınçlı kanal açma robotları kullanıyoruz.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 bg-light p-4 rounded-4">
                    <div class="fs-1 text-info mb-3"><i class="fa-solid fa-user-shield"></i></div>
                    <h5 class="fw-bold">Garantili İşçilik</h5>
                    <p class="text-muted small mb-0">Tüm tamir, parça değişimi ve arıtma montaj işlemlerimizde yazılı garanti sunuyoruz.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 bg-light p-4 rounded-4">
                    <div class="fs-1 text-warning mb-3"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <h5 class="fw-bold">7/24 Mobil Servis</h5>
                    <p class="text-muted small mb-0">Gece veya tatil günü fark etmeksizin acil durumlarda 30 dakika içinde adresteyiz.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/layouts/footer.php'; ?>
