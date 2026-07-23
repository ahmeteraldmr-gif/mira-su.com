<?php require __DIR__ . '/../layouts/admin.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">Hizmet Yönetimi</h4>
        <p class="text-muted small mb-0">Sitede yayınlanan tesisat ve arıtma hizmetlerinin listesi ve güncellenmesi.</p>
    </div>
    <button class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#newServiceModal">
        <i class="fa-solid fa-plus me-1"></i> Yeni Hizmet Ekle
    </button>
</div>

<div class="row g-4">
    <?php foreach ($services as $s): ?>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="feature-icon m-0" style="width:50px;height:50px;font-size:1.4rem;">
                            <i class="fa-solid <?= htmlspecialchars($s['icon']) ?>"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold m-0"><?= htmlspecialchars($s['title']) ?></h5>
                            <span class="badge bg-light text-dark border small mt-1"><?= htmlspecialchars($s['price']) ?></span>
                        </div>
                    </div>
                    <div>
                        <?php if ($s['is_active']): ?>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-secondary px-2 py-1">Pasif</span>
                        <?php endif; ?>
                    </div>
                </div>

                <p class="text-muted small mb-4"><?= htmlspecialchars($s['summary']) ?></p>

                <div class="d-flex justify-content-end gap-2 pt-3 border-top mt-auto">
                    <button class="btn btn-sm btn-outline-primary fw-bold" data-bs-toggle="modal" data-bs-target="#editServiceModal<?= $s['id'] ?>">
                        <i class="fa-solid fa-pen-to-square me-1"></i> Düzenle
                    </button>
                    <form action="<?= url('/admin/services/delete') ?>" method="POST" class="form-confirm-delete d-inline">
                        <input type="hidden" name="id" value="<?= $s['id'] ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i> Sil</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editServiceModal<?= $s['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-4">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold">Hizmet Düzenle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="<?= url('/admin/services/update') ?>" method="POST">
                        <input type="hidden" name="id" value="<?= $s['id'] ?>">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Hizmet Başlığı *</label>
                                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($s['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">FontAwesome İkon Kodu *</label>
                                <input type="text" name="icon" class="form-control" value="<?= htmlspecialchars($s['icon']) ?>" required placeholder="fa-magnifying-glass">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Fiyat / Etiket Bilgisi</label>
                                <input type="text" name="price" class="form-control" value="<?= htmlspecialchars($s['price']) ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Kısa Özet</label>
                                <textarea name="summary" class="form-control" rows="2"><?= htmlspecialchars($s['summary']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Detaylı Açıklama</label>
                                <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($s['description']) ?></textarea>
                            </div>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="feat<?= $s['id'] ?>" <?= $s['is_featured'] ? 'checked' : '' ?>>
                                <label class="form-check-label fw-bold small" for="feat<?= $s['id'] ?>">Ana Sayfada Öne Çıkar</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" id="act<?= $s['id'] ?>" <?= $s['is_active'] ? 'checked' : '' ?>>
                                <label class="form-check-label fw-bold small" for="act<?= $s['id'] ?>">Aktif Yayınla</label>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">İptal</button>
                            <button type="submit" class="btn btn-primary fw-bold">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- New Service Modal -->
<div class="modal fade" id="newServiceModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Yeni Hizmet Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= url('/admin/services/store') ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Hizmet Başlığı *</label>
                        <input type="text" name="title" class="form-control" required placeholder="Örn: Lavabo Tıkanıklığı Açma">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">FontAwesome İkon Kodu *</label>
                        <input type="text" name="icon" class="form-control" required value="fa-wrench">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Fiyat / Etiket Bilgisi</label>
                        <input type="text" name="price" class="form-control" placeholder="Örn: Sabit Fiyat">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Kısa Özet</label>
                        <textarea name="summary" class="form-control" rows="2" placeholder="Kısa tanıtım yazısı..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Detaylı Açıklama</label>
                        <textarea name="description" class="form-control" rows="4" placeholder="Detaylı hizmet bilgisi..."></textarea>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="new_feat" checked>
                        <label class="form-check-label fw-bold small" for="new_feat">Ana Sayfada Öne Çıkar</label>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="new_act" checked>
                        <label class="form-check-label fw-bold small" for="new_act">Aktif Yayınla</label>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-primary fw-bold">Hizmeti Ekle</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/admin_footer.php'; ?>
