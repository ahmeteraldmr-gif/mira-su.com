<?php require __DIR__ . '/../layouts/admin.php'; ?>

<div class="table-custom p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Gelen İletişim Mesajları</h4>
            <p class="text-muted small mb-0">İletişim formundan gönderilen müşteri mesajları.</p>
        </div>
    </div>

    <?php if (empty($messages)): ?>
        <div class="text-center py-5">
            <i class="fa-solid fa-envelope-open text-muted display-4 mb-3"></i>
            <p class="text-muted">Gelen mesaj bulunamadı.</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Gönderen</th>
                        <th>Telefon / E-Posta</th>
                        <th>Konu</th>
                        <th>Mesaj</th>
                        <th>Tarih</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($messages as $m): ?>
                        <tr class="<?= $m['is_read'] ? '' : 'table-warning fw-bold' ?>">
                            <td><?= htmlspecialchars($m['name']) ?></td>
                            <td>
                                <div><a href="tel:<?= htmlspecialchars($m['phone']) ?>" class="text-decoration-none"><i class="fa-solid fa-phone me-1"></i> <?= htmlspecialchars($m['phone']) ?></a></div>
                                <small class="text-muted"><?= htmlspecialchars($m['email'] ?: '-') ?></small>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($m['subject'] ?: 'Genel') ?></span></td>
                            <td class="small max-w-300"><?= nl2br(htmlspecialchars($m['message'])) ?></td>
                            <td class="small text-muted"><?= date('d.m.Y H:i', strtotime($m['created_at'])) ?></td>
                            <td>
                                <?php if ($m['is_read']): ?>
                                    <span class="badge bg-secondary">Okundu</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Yeni Mesaj</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <?php if (!$m['is_read']): ?>
                                        <form action="/admin/messages/read" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $m['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Okundu İşaretle"><i class="fa-solid fa-check"></i></button>
                                        </form>
                                    <?php endif; ?>
                                    <form action="/admin/messages/delete" method="POST" class="form-confirm-delete d-inline">
                                        <input type="hidden" name="id" value="<?= $m['id'] ?>">
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
