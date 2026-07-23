<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Miraç Su Tesisatı & Arıtma Sistemleri') ?></title>
    <meta name="description" content="Miraç Su Tesisatı - Robotla kırmadan dökmeden su kaçağı tespiti, tıkanıklık açma, petek temizliği ve su arıtma sistemleri montajı. 7/24 Acil Servis.">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
</head>
<body>

    <!-- Mobile Navigation Overlay & Drawer -->
    <div class="mobile-nav-backdrop" id="mobileNavBackdrop" onclick="this.classList.remove('show'); document.getElementById('mobileNavDrawer').classList.remove('show');"></div>
    
    <div class="mobile-nav-drawer" id="mobileNavDrawer">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary">
            <a href="/" class="brand-logo">
                <div class="brand-icon">
                    <i class="fa-solid fa-droplet"></i>
                </div>
                <div class="brand-text">
                    MİRAÇ <span>SU</span>
                </div>
            </a>
            <button class="btn text-white fs-3 p-0" onclick="document.getElementById('mobileNavDrawer').classList.remove('show'); document.getElementById('mobileNavBackdrop').classList.remove('show');">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <ul class="mobile-nav-menu">
            <li><a href="/" class="<?= ($activePage ?? '') === 'home' ? 'active' : '' ?>"><i class="fa-solid fa-house me-2"></i> Ana Sayfa</a></li>
            <li><a href="/hakkimizda" class="<?= ($activePage ?? '') === 'about' ? 'active' : '' ?>"><i class="fa-solid fa-address-card me-2"></i> Hakkımızda</a></li>
            <li><a href="/hizmetler" class="<?= ($activePage ?? '') === 'services' ? 'active' : '' ?>"><i class="fa-solid fa-wrench me-2"></i> Hizmetlerimiz</a></li>
            <li><a href="/galeri" class="<?= ($activePage ?? '') === 'gallery' ? 'active' : '' ?>"><i class="fa-solid fa-images me-2"></i> Galeri & Projeler</a></li>
            <li><a href="/iletisim" class="<?= ($activePage ?? '') === 'contact' ? 'active' : '' ?>"><i class="fa-solid fa-phone me-2"></i> İletişim</a></li>
        </ul>

        <div class="mt-4 pt-3 border-top border-secondary">
            <button class="btn btn-warning btn-lg w-100 rounded-pill fw-bold text-dark trigger-booking-modal" data-bs-toggle="modal" data-bs-target="#quickBookingModal" onclick="document.getElementById('mobileNavDrawer').classList.remove('show'); document.getElementById('mobileNavBackdrop').classList.remove('show');">
                <i class="fa-solid fa-bolt me-2"></i> Acil Servis Çağır
            </button>
        </div>
    </div>

    <!-- Main Navbar -->
    <nav class="navbar-custom">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="/" class="brand-logo">
                <div class="brand-icon">
                    <i class="fa-solid fa-droplet"></i>
                </div>
                <div class="brand-text">
                    MİRAÇ <span>SU</span>
                </div>
            </a>

            <!-- Hamburger Button for Mobile -->
            <button class="btn text-white d-lg-none fs-3 p-1" id="mobileNavToggle" onclick="document.getElementById('mobileNavDrawer').classList.add('show'); document.getElementById('mobileNavBackdrop').classList.add('show');" aria-label="Menüyü Aç">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Desktop Nav Links -->
            <ul class="nav-links d-none d-lg-flex" id="navLinksContainer">
                <li><a href="/" class="nav-link-item <?= ($activePage ?? '') === 'home' ? 'active' : '' ?>">Ana Sayfa</a></li>
                <li><a href="/hakkimizda" class="nav-link-item <?= ($activePage ?? '') === 'about' ? 'active' : '' ?>">Hakkımızda</a></li>
                <li><a href="/hizmetler" class="nav-link-item <?= ($activePage ?? '') === 'services' ? 'active' : '' ?>">Hizmetlerimiz</a></li>
                <li><a href="/galeri" class="nav-link-item <?= ($activePage ?? '') === 'gallery' ? 'active' : '' ?>">Galeri & Projeler</a></li>
                <li><a href="/iletisim" class="nav-link-item <?= ($activePage ?? '') === 'contact' ? 'active' : '' ?>">İletişim</a></li>
            </ul>

            <div class="d-none d-lg-block">
                <button class="btn-emergency trigger-booking-modal" data-bs-toggle="modal" data-bs-target="#quickBookingModal">
                    <i class="fa-solid fa-bolt"></i> Acil Servis Çağır
                </button>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if (!empty($_SESSION['flash_success'])): ?>
        <div class="alert alert-success alert-dismissible fade show m-0 rounded-0 border-0 alert-auto-dismiss text-center py-3 fw-bold" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> <?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['flash_error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show m-0 rounded-0 border-0 alert-auto-dismiss text-center py-3 fw-bold" role="alert">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
        </div>
    <?php endif; ?>
