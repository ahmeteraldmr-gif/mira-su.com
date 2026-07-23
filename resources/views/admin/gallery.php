<?php require __DIR__ . '/../layouts/admin.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-images text-primary me-2"></i> Galeri Yönetimi</h4>
        <p class="text-muted small mb-0">Sitede yayınlanan çalışma ve cihaz fotoğraflarının listesi ve güncellenmesi.</p>
    </div>
    <button class="btn btn-primary fw-bold" data-bs-toggle="modal" data-bs-target="#newGalleryModal">
        <i class="fa-solid fa-plus me-1"></i> Yeni Fotoğraf Ekle
    </button>
</div>

<div class="row g-4">
    <?php foreach ($items as $item): ?>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
                <div style="height: 220px; overflow: hidden; background: #000;" class="position-relative">
                    <img src="<?= asset($item['image_url']) ?>" class="w-100 h-100" style="object-fit: cover;" alt="<?= htmlspecialchars($item['title']) ?>">
                    <span class="badge bg-primary position-absolute top-0 start-0 m-3 px-3 py-2">
                        <?= $item['category'] === 'kacak' ? 'Akustik Kaçak' : ($item['category'] === 'robot' ? 'Gider Robotu' : 'Termal Kamera') ?>
                    </span>
                </div>
                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="fw-bold text-dark mb-2"><?= htmlspecialchars($item['title']) ?></h5>
                    <p class="text-muted small mb-4 flex-grow-1"><?= htmlspecialchars($item['description']) ?></p>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
                        <button class="btn btn-sm btn-outline-primary fw-bold" data-bs-toggle="modal" data-bs-target="#editGalleryModal<?= $item['id'] ?>">
                            <i class="fa-solid fa-pen-to-square me-1"></i> Düzenle
                        </button>
                        <form action="/admin/gallery/delete" method="POST" class="form-confirm-delete d-inline">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i> Sil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editGalleryModal<?= $item['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-4">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold">Fotoğraf Düzenle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="/admin/gallery/update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Fotoğraf Başlığı *</label>
                                <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($item['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Kategori *</label>
                                <select name="category" class="form-select">
                                    <option value="kacak" <?= $item['category'] === 'kacak' ? 'selected' : '' ?>>Akustik Kaçak Tespiti</option>
                                    <option value="robot" <?= $item['category'] === 'robot' ? 'selected' : '' ?>>Kameralı Robot Sistemleri</option>
                                    <option value="termal" <?= $item['category'] === 'termal' ? 'selected' : '' ?>>Termal Kamera</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Fotoğraf Yolu / Bağlantısı *</label>
                                <input type="text" name="image_url" class="form-control" value="<?= htmlspecialchars($item['image_url']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Veya Yeni Fotoğraf Yükle</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small">Açıklama</label>
                                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($item['description']) ?></textarea>
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

<!-- New Gallery Modal -->
<div class="modal fade" id="newGalleryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Yeni Fotoğraf Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/admin/gallery/store" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Fotoğraf Başlığı *</label>
                        <input type="text" name="title" class="form-control" required placeholder="Örn: Termal Kaçak Tespiti">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Kategori *</label>
                        <select name="category" class="form-select">
                            <option value="kacak">Akustik Kaçak Tespiti</option>
                            <option value="robot">Kameralı Robot Sistemleri</option>
                            <option value="termal">Termal Kamera</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Fotoğraf Yolu / URL</label>
                        <input type="text" name="image_url" class="form-control" placeholder="/images/gallery_real_1.jpg" value="/images/gallery_real_1.jpg">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Veya Bilgisayardan Fotoğraf Yükle</label>
                        <input type="file" name="image_file" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Açıklama</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Saha veya ekipman açıklaması..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">İptal</button>
                    <button type="submit" class="btn btn-primary fw-bold">Fotoğrafı Ekle</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/admin_footer.php'; ?>
