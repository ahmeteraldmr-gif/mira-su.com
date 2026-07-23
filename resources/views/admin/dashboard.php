<?php require __DIR__ . '/../layouts/admin.php'; ?>

<!-- Statistics Cards -->
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="stat-card-admin">
            <div>
                <h6 class="text-muted fw-bold mb-1">Toplam Randevular</h6>
                <h3 class="fw-bold m-0 text-dark"><?= $totalBookings ?></h3>
            </div>
            <div class="stat-icon-wrapper">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card-admin">
            <div>
                <h6 class="text-muted fw-bold mb-1">Bekleyen Talepler</h6>
                <h3 class="fw-bold m-0 text-warning"><?= $pendingBookings ?></h3>
            </div>
            <div class="stat-icon-wrapper text-warning bg-warning-subtle">
                <i class="fa-solid fa-clock"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card-admin">
            <div>
                <h6 class="text-muted fw-bold mb-1">Okunmamış Mesajlar</h6>
                <h3 class="fw-bold m-0 text-info"><?= $unreadMessages ?></h3>
            </div>
            <div class="stat-icon-wrapper text-info bg-info-subtle">
                <i class="fa-solid fa-envelope"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card-admin">
            <div>
                <h6 class="text-muted fw-bold mb-1">Aktif Hizmetler</h6>
                <h3 class="fw-bold m-0 text-success"><?= $servicesCount ?></h3>
            </div>
            <div class="stat-icon-wrapper text-success bg-success-subtle">
                <i class="fa-solid fa-wrench"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Bookings -->
    <div class="col-lg-7">
        <div class="table-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark m-0"><i class="fa-solid fa-list-check text-primary me-2"></i> Son Servis Talepleri</h5>
                <a href="/admin/bookings" class="btn btn-sm btn-outline-primary fw-bold">Tümünü Gör</a>
            </div>

            <?php if (empty($recentBookings)): ?>
                <p class="text-muted text-center py-4">Henüz gelen servis talebi yok.</p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Müşteri</th>
                                <th>Hizmet</th>
                                <th>Tarih</th>
                                <th>Durum</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentBookings as $b): ?>
                                <tr>
                                    <td>
                                        <div class="fw-bold"><?= htmlspecialchars($b['name']) ?></div>
                                        <div class="small text-muted"><?= htmlspecialchars($b['phone']) ?></div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($b['service_name']) ?></span></td>
                                    <td class="small text-muted"><?= date('d.m.Y H:i', strtotime($b['created_at'])) ?></td>
                                    <td>
                                        <?php if ($b['status'] === 'Bekliyor'): ?>
                                            <span class="badge bg-warning text-dark">Bekliyor</span>
                                        <?php elseif ($b['status'] === 'İşlemde'): ?>
                                            <span class="badge bg-info text-dark">İşlemde</span>
                                        <?php elseif ($b['status'] === 'Tamamlandı'): ?>
                                            <span class="badge bg-success">Tamamlandı</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">İptal</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="col-lg-5">
        <div class="table-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-dark m-0"><i class="fa-solid fa-comments text-info me-2"></i> Son Mesajlar</h5>
                <a href="/admin/messages" class="btn btn-sm btn-outline-info fw-bold">Tümünü Gör</a>
            </div>

            <?php if (empty($recentMessages)): ?>
                <p class="text-muted text-center py-4">Henüz mesaj gönderilmemiş.</p>
            <?php else: ?>
                <div class="list-group list-group-flush">
                    <?php foreach ($recentMessages as $m): ?>
                        <div class="list-group-item px-0 py-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark"><?= htmlspecialchars($m['name']) ?></span>
                                <small class="text-muted"><?= date('d.m H:i', strtotime($m['created_at'])) ?></small>
                            </div>
                            <div class="small text-secondary mb-1"><?= htmlspecialchars($m['subject'] ?: 'İletişim Formu') ?></div>
                            <p class="small text-muted m-0 text-truncate"><?= htmlspecialchars($m['message']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layouts/admin_footer.php'; ?>
