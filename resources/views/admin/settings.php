<?php require __DIR__ . '/../layouts/admin.php'; ?>

<div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-gears text-primary me-2"></i> Genel Site Ayarları</h4>
        <p class="text-muted small mb-0">Telefon numarası, adres, WhatsApp hattı ve genel firma bilgilerini güncelleyin.</p>
    </div>

    <form action="<?= url('/admin/settings/update') ?>" method="POST">
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">Firma / Site Adı</label>
                <input type="text" name="site_name" class="form-control form-control-lg fs-6" value="<?= htmlspecialchars($settings['site_name'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">Sabit / Cep Telefonu</label>
                <input type="text" name="site_phone" class="form-control form-control-lg fs-6" value="<?= htmlspecialchars($settings['site_phone'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">WhatsApp Numarası (Ülke kodu dahil, örn: 905320000000)</label>
                <input type="text" name="site_whatsapp" class="form-control form-control-lg fs-6" value="<?= htmlspecialchars($settings['site_whatsapp'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">Acil Çağrı Hattı</label>
                <input type="text" name="site_emergency" class="form-control form-control-lg fs-6" value="<?= htmlspecialchars($settings['site_emergency'] ?? '') ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">E-Posta Adresi</label>
                <input type="email" name="site_email" class="form-control form-control-lg fs-6" value="<?= htmlspecialchars($settings['site_email'] ?? '') ?>" required>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">Çalışma Saatleri Metni</label>
                <input type="text" name="working_hours" class="form-control form-control-lg fs-6" value="<?= htmlspecialchars($settings['working_hours'] ?? '') ?>">
            </div>

            <div class="col-12">
                <label class="form-label fw-bold text-secondary">Açık Adres</label>
                <textarea name="site_address" class="form-control fs-6" rows="3" required><?= htmlspecialchars($settings['site_address'] ?? '') ?></textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">Facebook Profil Bağlantısı</label>
                <input type="url" name="facebook_url" class="form-control" value="<?= htmlspecialchars($settings['facebook_url'] ?? '') ?>">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">Instagram Profil Bağlantısı</label>
                <input type="url" name="instagram_url" class="form-control" value="<?= htmlspecialchars($settings['instagram_url'] ?? '') ?>">
            </div>

            <div class="col-12 mt-4 pt-3 border-top">
                <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-address-card text-info me-2"></i> Hakkımızda Sayfası İçerikleri</h5>
            </div>

            <div class="col-12">
                <label class="form-label fw-bold text-secondary">Hakkımızda Hikayesi & Detay Metni</label>
                <textarea name="about_story" class="form-control" rows="4"><?= htmlspecialchars($settings['about_story'] ?? 'Miraç Su Tesisatı & Arıtma Sistemleri, Ada ve çevre bölgelerde sıhhi tesisat sektörünün eksikliklerini ve müşteri mağduriyetlerini gidermek amacıyla kurulmuştur.') ?></textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">Misyonumuz Metni</label>
                <textarea name="about_mission" class="form-control" rows="3"><?= htmlspecialchars($settings['about_mission'] ?? 'Teknolojik cihazlarla kırmadan %100 kesin çözümler sunarak müşteri memnuniyetini en üst seviyede tutmak.') ?></textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-bold text-secondary">Vizyonumuz Metni</label>
                <textarea name="about_vision" class="form-control" rows="3"><?= htmlspecialchars($settings['about_vision'] ?? 'Bölgenin en güvenilir, en hızlı ve yenilikçi su tesisatı & arıtma markası konumunu sürdürmek.') ?></textarea>
            </div>

            <div class="col-12 text-end pt-3 border-top">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 fw-bold">
                    <i class="fa-solid fa-floppy-disk me-2"></i> Ayarları Kaydet
                </button>
            </div>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layouts/admin_footer.php'; ?>
