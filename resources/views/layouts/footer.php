    <!-- Floating WhatsApp & Phone Widgets -->
    <div class="floating-actions">
        <a href="https://wa.me/<?= htmlspecialchars($settings['site_whatsapp'] ?? '905320000000') ?>?text=Merhaba,%20su%20tesisatı%20servis%20talebinde%20bulunmak%20istiyorum." target="_blank" class="floating-btn btn-whatsapp-float" title="WhatsApp Ulaşın">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <a href="tel:<?= preg_replace('/[^0-9]/', '', $settings['site_phone'] ?? '05320000000') ?>" class="floating-btn btn-call-float" title="Hemen Ara">
            <i class="fa-solid fa-phone-volume"></i>
        </a>
    </div>

    <!-- Quick Booking Modal -->
    <div class="modal fade" id="quickBookingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom p-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title font-weight-bold text-dark fs-4">
                        <i class="fa-solid fa-droplet text-info me-2"></i> Hızlı Servis Talebi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-4">Formu doldurun, mobil acil ekibimiz 15 dakika içinde sizi arasın.</p>
                    <form action="/randevu-al" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Adınız Soyadınız *</label>
                            <input type="text" name="name" class="form-control form-control-lg fs-6" placeholder="Örn: Ahmet Yılmaz" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Telefon Numaranız *</label>
                            <input type="tel" name="phone" class="form-control form-control-lg fs-6" placeholder="05XX XXX XX XX" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Hizmet Seçimi</label>
                            <select name="service_name" id="modalServiceSelect" class="form-select form-select-lg fs-6">
                                <option value="Robotla Su Kaçağı Tespiti">Robotla Su Kaçağı Tespiti</option>
                                <option value="Tıkanıklık Açma & Kanal Temizleme">Tıkanıklık Açma & Kanal Temizleme</option>
                                <option value="Petek Temizliği & Kombi Bakımı">Petek Temizliği & Kombi Bakımı</option>
                                <option value="Su Arıtma Montajı & Filtre Değişimi">Su Arıtma Montajı & Filtre Değişimi</option>
                                <option value="7/24 Acil Sıhhi Tesisat & Tamirat">7/24 Acil Sıhhi Tesisat & Tamirat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary">Adresiniz / Bölgeniz *</label>
                            <textarea name="address" class="form-control fs-6" rows="2" placeholder="Mahalle, Sokak ve İlçe bilgisi..." required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">Arıza Notu (Opsiyonel)</label>
                            <input type="text" name="notes" class="form-control fs-6" placeholder="Örn: Mutfak gideri tıkandı, sızıntı var.">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3">
                            <i class="fa-solid fa-paper-plane me-2"></i> Talebi Gönder
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-custom">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <a href="/" class="brand-logo mb-3 d-inline-flex">
                        <div class="brand-icon">
                            <i class="fa-solid fa-droplet"></i>
                        </div>
                        <div class="brand-text">
                            MİRAÇ <span>SU</span>
                        </div>
                    </a>
                    <p class="footer-desc mt-3">
                        Miraç Su Tesisatı & Arıtma Sistemleri olarak 15 yılı aşkın tecrübemiz, son teknoloji termal kamera ve kameralı robotlarımızla kırmadan dökmeden profesyonel çözümler sunuyoruz.
                    </p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="<?= htmlspecialchars($settings['facebook_url'] ?? '#') ?>" class="social-icon-btn"><i class="fa-brands fa-facebook"></i></a>
                        <a href="<?= htmlspecialchars($settings['instagram_url'] ?? '#') ?>" class="social-icon-btn"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/<?= htmlspecialchars($settings['site_whatsapp'] ?? '905320000000') ?>" class="social-icon-btn whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6">
                    <h5 class="footer-title">Hızlı Bağlantılar</h5>
                    <ul class="footer-links">
                        <li><a href="<?= url('/') ?>">Ana Sayfa</a></li>
                        <li><a href="<?= url('/hakkimizda') ?>">Hakkımızda</a></li>
                        <li><a href="<?= url('/hizmetler') ?>">Hizmetlerimiz</a></li>
                        <li><a href="<?= url('/galeri') ?>">Galeri & Projeler</a></li>
                        <li><a href="<?= url('/iletisim') ?>">İletişim</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-6">
                    <h5 class="footer-title">Hizmetlerimiz</h5>
                    <ul class="footer-links">
                        <li><a href="<?= url('/hizmetler') ?>">Su Kaçağı Tespiti</a></li>
                        <li><a href="<?= url('/hizmetler') ?>">Robotla Tıkanıklık Açma</a></li>
                        <li><a href="<?= url('/hizmetler') ?>">Petek & Kombi Yıkama</a></li>
                        <li><a href="<?= url('/hizmetler') ?>">Su Arıtma Montajı</a></li>
                        <li><a href="<?= url('/hizmetler') ?>">7/24 Acil Tesisatçı</a></li>
                    </ul>
                </div>

                <div class="col-lg-3">
                    <h5 class="footer-title">İletişim Bilgileri</h5>
                    <ul class="list-unstyled footer-contact-list">
                        <li class="mb-3 d-flex gap-2 align-items-start">
                            <i class="fa-solid fa-location-dot text-info fs-5 mt-1 me-1"></i>
                            <span class="footer-info-text"><?= htmlspecialchars($settings['site_address'] ?? 'Ada / İstanbul') ?></span>
                        </li>
                        <li class="mb-3 d-flex gap-2 align-items-center">
                            <i class="fa-solid fa-phone text-info fs-5 me-1"></i>
                            <a href="tel:<?= preg_replace('/[^0-9]/', '', $settings['site_phone'] ?? '') ?>" class="footer-phone-link"><?= htmlspecialchars($settings['site_phone'] ?? '0532 000 00 00') ?></a>
                        </li>
                        <li class="mb-3 d-flex gap-2 align-items-center">
                            <i class="fa-solid fa-envelope text-info fs-5 me-1"></i>
                            <span class="footer-info-text"><?= htmlspecialchars($settings['site_email'] ?? 'info@miracsu.com') ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom pt-4 text-center">
                <p class="m-0">&copy; <?= date('Y') ?> Miraç Su Tesisatı & Arıtma Sistemleri. Tüm Hakları Saklıdır.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>
