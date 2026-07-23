<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Girişi - Miraç Su Panel</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: system-ui, -apple-system, sans-serif;
        }
        .login-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 420px;
            padding: 40px;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="text-center mb-4">
        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width:64px;height:64px;font-size:1.8rem;">
            <i class="fa-solid fa-droplet"></i>
        </div>
        <h3 class="fw-bold text-dark mb-1">MİRAÇ SU</h3>
        <p class="text-muted small">Yönetim Paneli Girişi</p>
    </div>

    <?php if (!empty($_SESSION['admin_error'])): ?>
        <div class="alert alert-danger small py-2 text-center mb-3">
            <?= $_SESSION['admin_error']; unset($_SESSION['admin_error']); ?>
        </div>
    <?php endif; ?>

    <form action="/admin/login" method="POST">
        <div class="mb-3">
            <label class="form-label fw-bold text-secondary small">Kullanıcı Adı</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                <input type="text" name="username" class="form-control" placeholder="admin" required value="admin">
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold text-secondary small">Şifre</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                <input type="password" name="password" class="form-control" placeholder="password123" required value="password123">
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold py-3">
            <i class="fa-solid fa-right-to-bracket me-2"></i> Oturum Aç
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="/" class="text-decoration-none text-muted small"><i class="fa-solid fa-arrow-left"></i> Ana Sayfaya Dön</a>
    </div>
</div>

</body>
</html>
