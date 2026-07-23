<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Yönetim Paneli - Miraç Su') ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Admin CSS -->
    <link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
</head>
<body class="admin-body">

<div class="admin-layout">
    <!-- Backdrop Overlay for Mobile -->
    <div class="admin-sidebar-backdrop d-lg-none" id="adminSidebarBackdrop" onclick="this.classList.remove('show'); document.getElementById('adminSidebar').classList.remove('show');"></div>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="admin-sidebar-brand d-flex justify-content-between align-items-center">
            <div>
                <i class="fa-solid fa-droplet text-info me-2"></i> MİRAÇ <span>SU</span> <small class="fs-6 text-muted fw-normal">Panel</small>
            </div>
            <button class="btn text-white-50 d-lg-none fs-4 p-0 border-0" id="adminSidebarClose" onclick="document.getElementById('adminSidebar').classList.remove('show'); document.getElementById('adminSidebarBackdrop').classList.remove('show');"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <ul class="admin-nav">
            <li class="admin-nav-item <?= ($activeAdminPage ?? '') === 'dashboard' ? 'active' : '' ?>">
                <a href="<?= url('/admin/dashboard') ?>"><i class="fa-solid fa-chart-line"></i> Gösterge Paneli</a>
            </li>
            <li class="admin-nav-item <?= ($activeAdminPage ?? '') === 'bookings' ? 'active' : '' ?>">
                <a href="<?= url('/admin/bookings') ?>"><i class="fa-solid fa-calendar-check"></i> Servis Talepleri</a>
            </li>
            <li class="admin-nav-item <?= ($activeAdminPage ?? '') === 'services' ? 'active' : '' ?>">
                <a href="<?= url('/admin/services') ?>"><i class="fa-solid fa-wrench"></i> Hizmet Yönetimi</a>
            </li>
            <li class="admin-nav-item <?= ($activeAdminPage ?? '') === 'gallery' ? 'active' : '' ?>">
                <a href="<?= url('/admin/gallery') ?>"><i class="fa-solid fa-images"></i> Galeri Yönetimi</a>
            </li>
            <li class="admin-nav-item <?= ($activeAdminPage ?? '') === 'messages' ? 'active' : '' ?>">
                <a href="<?= url('/admin/messages') ?>"><i class="fa-solid fa-envelope"></i> Gelen Mesajlar</a>
            </li>
            <li class="admin-nav-item <?= ($activeAdminPage ?? '') === 'settings' ? 'active' : '' ?>">
                <a href="<?= url('/admin/settings') ?>"><i class="fa-solid fa-gears"></i> Site & Hakkımızda Ayarları</a>
            </li>
        </ul>

        <div class="mt-auto px-4 text-center pb-4">
            <a href="<?= url('/') ?>" target="_blank" class="btn btn-outline-light btn-sm w-100 mb-2"><i class="fa-solid fa-globe me-1"></i> Siteyi Görüntüle</a>
            <a href="<?= url('/admin/logout') ?>" class="btn btn-danger btn-sm w-100"><i class="fa-solid fa-right-from-bracket me-1"></i> Çıkış Yap</a>
        </div>
    </aside>

    <!-- Main Section -->
    <div class="admin-content">
        <header class="admin-topbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-primary d-lg-none me-3 fs-5 px-3 py-1 rounded-3 shadow-sm" id="adminMobileNavToggle" onclick="document.getElementById('adminSidebar').classList.add('show'); document.getElementById('adminSidebarBackdrop').classList.add('show');" title="Menü Göster/Gizle">
                    <i class="fa-solid fa-bars me-1"></i> <span class="fs-6 fw-bold">Menü</span>
                </button>
                <h4 class="m-0 font-weight-bold text-dark fs-5 fs-md-4"><?= htmlspecialchars($title ?? 'Yönetim Paneli') ?></h4>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small d-none d-sm-inline"><i class="fa-solid fa-user-circle text-primary me-1"></i> <?= htmlspecialchars($_SESSION['admin_user']['name'] ?? 'Yönetici') ?></span>
            </div>
        </header>

        <main class="admin-main">
            <?php if (!empty($_SESSION['admin_flash'])): ?>
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="fa-solid fa-check-circle me-2"></i> <?= $_SESSION['admin_flash']; unset($_SESSION['admin_flash']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
