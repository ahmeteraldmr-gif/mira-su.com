<?php require __DIR__ . '/../layouts/admin.php'; ?>

<div class="table-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Servis Talepleri & Randevular</h4>
            <p class="text-muted small mb-0">Müşterilerden gelen tüm acil servis ve keşif talepleri.</p>
        </div>
    </div>

    <?php if (empty($bookings)): ?>
        <div class="text-center py-5">
            <i class="fa-solid fa-inbox text-muted display-4 mb-3"></i>
            <p class="text-muted">Kayıtlı randevu bulunamadı.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Müşteri Bilgileri</th>
                        <th>Talep Edilen Hizmet</th>
                        <th>Adres / Bölge</th>
                        <th>Notlar</th>
                        <th>Tarih</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $b): ?>
                        <tr>
                            <td class="fw-bold">#<?= $b['id'] ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($b['name']) ?></div>
                                <a href="tel:<?= htmlspecialchars($b['phone']) ?>" class="small text-primary text-decoration-none fw-bold"><i class="fa-solid fa-phone"></i> <?= htmlspecialchars($b['phone']) ?></a>
                            </td>
                            <td><span class="badge bg-light text-primary border border-primary-subtle px-3 py-2 fs-6"><?= htmlspecialchars($b['service_name']) ?></span></td>
                            <td class="small max-w-200"><?= htmlspecialchars($b['address']) ?></td>
                            <td class="small text-muted"><?= htmlspecialchars($b['notes'] ?: '-') ?></td>
                            <td class="small text-muted"><?= date('d.m.Y H:i', strtotime($b['created_at'])) ?></td>
                            <td>
                                <form action="<?= url('/admin/bookings/status') ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                    <select name="status" class="form-select form-select-sm fw-bold border-0 text-white" onchange="this.form.submit()" style="background-color: <?= $b['status'] === 'Bekliyor' ? '#EAB308' : ($b['status'] === 'İşlemde' ? '#0EA5E9' : ($b['status'] === 'Tamamlandı' ? '#22C55E' : '#64748B')) ?>;">
                                        <option value="Bekliyor" <?= $b['status'] === 'Bekliyor' ? 'selected' : '' ?>>Bekliyor</option>
                                        <option value="İşlemde" <?= $b['status'] === 'İşlemde' ? 'selected' : '' ?>>İşlemde</option>
                                        <option value="Tamamlandı" <?= $b['status'] === 'Tamamlandı' ? 'selected' : '' ?>>Tamamlandı</option>
                                        <option value="İptal" <?= $b['status'] === 'İptal' ? 'selected' : '' ?>>İptal</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="https://wa.me/90<?= preg_replace('/[^0-9]/', '', $b['phone']) ?>" target="_blank" class="btn btn-sm btn-success" title="WhatsApp Mesaj Gönder"><i class="fa-brands fa-whatsapp"></i></a>
                                    <form action="<?= url('/admin/bookings/delete') ?>" method="POST" class="form-confirm-delete d-inline">
                                        <input type="hidden" name="id" value="<?= $b['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Sil"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/admin_footer.php'; ?>
