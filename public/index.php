<?php

session_start();

// Basic PSR-4 Autoloader for App namespace
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Initialize Database Connection & Tables
\App\Database\Database::getConnection();

// Simple Router
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove trailing slash except root
if ($requestUri !== '/' && substr($requestUri, -1) === '/') {
    $requestUri = rtrim($requestUri, '/');
}

$routes = require __DIR__ . '/../routes/web.php';
$routeKey = "$requestMethod $requestUri";

if (isset($routes[$routeKey])) {
    [$controllerClass, $method] = $routes[$routeKey];
    $controller = new $controllerClass();
    $controller->$method();
} else {
    http_response_code(404);
    $title = "404 Sayfa Bulunamadı - Miraç Su";
    $settings = \App\Models\Setting::getAll();
    require __DIR__ . '/../resources/views/layouts/app.php';
    echo '<div class="container py-5 text-center my-5"><h1 class="display-3 font-weight-bold text-primary mb-3"><i class="fa-solid fa-water-ladder text-info"></i> 404</h1><p class="lead">Aradığınız sayfa bulunamadı veya kaldırılmış olabilir.</p><a href="/" class="btn btn-primary mt-3"><i class="fa-solid fa-house"></i> Ana Sayfaya Dön</a></div>';
}
